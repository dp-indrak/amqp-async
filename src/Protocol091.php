<?php

namespace DataProcessors\AMQP;

class Protocol091
{

    /**
     * @return array
     */
    public function connectionStart($version_major = 0, $version_minor = 9, $server_properties, $mechanisms = 'PLAIN', $locales = 'en_US')
    {
        $args = new AMQPBufferWriter();
        $args->write_octet($version_major);
        $args->write_octet($version_minor);
        $args->write_table(empty($server_properties) ? array() : $server_properties);
        $args->write_longstr($mechanisms);
        $args->write_longstr($locales);
        return array(10, 10, $args);
    }



    /**
     * @param AMQPReader $args
     * @return array
     */
    public static function connectionStartOk($args)
    {
        $ret = array();
        $ret[] = $args->read_table();
        $ret[] = $args->read_shortstr();
        $ret[] = $args->read_longstr();
        $ret[] = $args->read_shortstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function connectionSecure($challenge)
    {
        $args = new AMQPBufferWriter();
        $args->write_longstr($challenge);
        return array(10, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function connectionSecureOk($args)
    {
        $ret = array();
        $ret[] = $args->read_longstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function connectionTune($channel_max = 0, $frame_max = 0, $heartbeat = 0)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($channel_max);
        $args->write_long($frame_max);
        $args->write_short($heartbeat);
        return array(10, 30, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function connectionTuneOk($args)
    {
        $ret = array();
        $ret[] = $args->read_short();
        $ret[] = $args->read_long();
        $ret[] = $args->read_short();
        return $ret;
    }



    /**
     * @return array
     */
    public function connectionOpen($virtual_host = '/', $reserved1 = '', $reserved2 = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_shortstr($virtual_host);
        $args->write_shortstr($reserved1);
        $args->write_bits(array($reserved2));
        return array(10, 40, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function connectionOpenOk($args)
    {
        $ret = array();
        $ret[] = $args->read_shortstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function connectionClose($reply_code, $reply_text = '', $class_id, $method_id)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reply_code);
        $args->write_shortstr($reply_text);
        $args->write_short($class_id);
        $args->write_short($method_id);
        return array(10, 50, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function connectionCloseOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function channelOpen($reserved1 = '')
    {
        $args = new AMQPBufferWriter();
        $args->write_shortstr($reserved1);
        return array(20, 10, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function channelOpenOk($args)
    {
        $ret = array();
        $ret[] = $args->read_longstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function channelFlow($active)
    {
        $args = new AMQPBufferWriter();
        $args->write_bits(array($active));
        return array(20, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function channelFlowOk($args)
    {
        $ret = array();
        $ret[] = $args->read_bit();
        return $ret;
    }



    /**
     * @return array
     */
    public function channelClose($reply_code, $reply_text = '', $class_id, $method_id)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reply_code);
        $args->write_shortstr($reply_text);
        $args->write_short($class_id);
        $args->write_short($method_id);
        return array(20, 40, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function channelCloseOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function exchangeDeclare($reserved1 = 0, $exchange, $type = 'direct', $passive = false, $durable = false, $reserved2 = false, $reserved3 = false, $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($exchange);
        $args->write_shortstr($type);
        $args->write_bits(array($passive, $durable, $reserved2, $reserved3, $nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(40, 10, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function exchangeDeclareOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function exchangeDelete($reserved1 = 0, $exchange, $if_unused = false, $nowait = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($exchange);
        $args->write_bits(array($if_unused, $nowait));
        return array(40, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function exchangeDeleteOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function exchangeBind($reserved1 = 0, $destination, $source, $routing_key = '', $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($destination);
        $args->write_shortstr($source);
        $args->write_shortstr($routing_key);
        $args->write_bits(array($nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(40, 30, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function exchangeBindOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function exchangeUnbind($reserved1 = 0, $destination, $source, $routing_key = '', $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($destination);
        $args->write_shortstr($source);
        $args->write_shortstr($routing_key);
        $args->write_bits(array($nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(40, 40, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function exchangeUnbindOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function queueDeclare($reserved1 = 0, $queue = '', $passive = false, $durable = false, $exclusive = false, $auto_delete = false, $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_bits(array($passive, $durable, $exclusive, $auto_delete, $nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(50, 10, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function queueDeclareOk($args)
    {
        $ret = array();
        $ret[] = $args->read_shortstr();
        $ret[] = $args->read_long();
        $ret[] = $args->read_long();
        return $ret;
    }



    /**
     * @return array
     */
    public function queueBind($reserved1 = 0, $queue = '', $exchange, $routing_key = '', $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_shortstr($exchange);
        $args->write_shortstr($routing_key);
        $args->write_bits(array($nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(50, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function queueBindOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function queuePurge($reserved1 = 0, $queue = '', $nowait = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_bits(array($nowait));
        return array(50, 30, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function queuePurgeOk($args)
    {
        $ret = array();
        $ret[] = $args->read_long();
        return $ret;
    }



    /**
     * @return array
     */
    public function queueDelete($ticket = 0, $queue = '', $if_unused = false, $if_empty = false, $nowait = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($ticket);
        $args->write_shortstr($queue);
        $args->write_bits(array($if_unused, $if_empty, $nowait));
        return array(50, 40, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function queueDeleteOk($args)
    {
        $ret = array();
        $ret[] = $args->read_long();
        return $ret;
    }



    /**
     * @return array
     */
    public function queueUnbind($reserved1 = 0, $queue = '', $exchange, $routing_key = '', $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_shortstr($exchange);
        $args->write_shortstr($routing_key);
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(50, 50, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function queueUnbindOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function basicQos($prefetch_size = 0, $prefetch_count = 0, $global = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_long($prefetch_size);
        $args->write_short($prefetch_count);
        $args->write_bits(array($global));
        return array(60, 10, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicQosOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function basicConsume($reserved1 = 0, $queue = '', $consumer_tag = '', $no_local = false, $no_ack = false, $exclusive = false, $nowait = false, $arguments = array())
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_shortstr($consumer_tag);
        $args->write_bits(array($no_local, $no_ack, $exclusive, $nowait));
        $args->write_table(empty($arguments) ? array() : $arguments);
        return array(60, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicConsumeOk($args)
    {
        $ret = array();
        $ret[] = $args->read_shortstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function basicCancel($consumer_tag, $nowait = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_shortstr($consumer_tag);
        $args->write_bits(array($nowait));
        return array(60, 30, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicCancelOk($args)
    {
        $ret = array();
        $ret[] = $args->read_shortstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function basicPublish($reserved1 = 0, $exchange = '', $routing_key = '', $mandatory = false, $immediate = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($exchange);
        $args->write_shortstr($routing_key);
        $args->write_bits(array($mandatory, $immediate));
        return array(60, 40, $args);
    }



    /**
     * @return array
     */
    public function basicReturn($reply_code, $reply_text = '', $exchange, $routing_key)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reply_code);
        $args->write_shortstr($reply_text);
        $args->write_shortstr($exchange);
        $args->write_shortstr($routing_key);
        return array(60, 50, $args);
    }



    /**
     * @return array
     */
    public function basicDeliver($consumer_tag, $delivery_tag, $redelivered = false, $exchange, $routing_key)
    {
        $args = new AMQPBufferWriter();
        $args->write_shortstr($consumer_tag);
        $args->write_longlong($delivery_tag);
        $args->write_bits(array($redelivered));
        $args->write_shortstr($exchange);
        $args->write_shortstr($routing_key);
        return array(60, 60, $args);
    }



    /**
     * @return array
     */
    public function basicGet($reserved1 = 0, $queue = '', $no_ack = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_short($reserved1);
        $args->write_shortstr($queue);
        $args->write_bits(array($no_ack));
        return array(60, 70, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicGetOk($args)
    {
        $ret = array();
        $ret[] = $args->read_longlong();
        $ret[] = $args->read_bit();
        $ret[] = $args->read_shortstr();
        $ret[] = $args->read_shortstr();
        $ret[] = $args->read_long();
        return $ret;
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicGetEmpty($args)
    {
        $ret = array();
        $ret[] = $args->read_shortstr();
        return $ret;
    }



    /**
     * @return array
     */
    public function basicAck($delivery_tag = 0, $multiple = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_longlong($delivery_tag);
        $args->write_bits(array($multiple));
        return array(60, 80, $args);
    }



    /**
     * @return array
     */
    public function basicReject($delivery_tag, $requeue = true)
    {
        $args = new AMQPBufferWriter();
        $args->write_longlong($delivery_tag);
        $args->write_bits(array($requeue));
        return array(60, 90, $args);
    }



    /**
     * @return array
     */
    public function basicRecoverAsync($requeue = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_bits(array($requeue));
        return array(60, 100, $args);
    }



    /**
     * @return array
     */
    public function basicRecover($requeue = false)
    {
        $args = new AMQPBufferWriter();
        $args->write_bits(array($requeue));
        return array(60, 110, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function basicRecoverOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function txSelect()
    {
        $args = new AMQPBufferWriter();
        return array(90, 10, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function txSelectOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function txCommit()
    {
        $args = new AMQPBufferWriter();
        return array(90, 20, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function txCommitOk($args)
    {
        $ret = array();
        return $ret;
    }



    /**
     * @return array
     */
    public function txRollback()
    {
        $args = new AMQPBufferWriter();
        return array(90, 30, $args);
    }



    /**
     * @param AMQPBufferReader $args
     * @return array
     */
    public static function txRollbackOk($args)
    {
        $ret = array();
        return $ret;
    }
}
