<?php

namespace DataProcessors\AMQP;

class Constants091
{

    public static $AMQP_PROTOCOL_HEADER = "AMQP\x00\x00\x09\x01";

    public static $FRAME_TYPES = array(
        1 => 'FRAME-METHOD',
        2 => 'FRAME-HEADER',
        3 => 'FRAME-BODY',
        8 => 'FRAME-HEARTBEAT',
        4096 => 'FRAME-MIN-SIZE',
        206 => 'FRAME-END',
        501 => 'FRAME-ERROR',
    );

    public static $CONTENT_METHODS = array(
        0 => '60,40',
        1 => '60,50',
        2 => '60,60',
        3 => '60,71',
    );

    public static $CLOSE_METHODS = array(
        0 => '10,50',
        1 => '20,40',
    );

    public static $GLOBAL_METHOD_NAMES = array(
        '10,10' => 'Connection.start',
        '10,11' => 'Connection.start_ok',
        '10,20' => 'Connection.secure',
        '10,21' => 'Connection.secure_ok',
        '10,30' => 'Connection.tune',
        '10,31' => 'Connection.tune_ok',
        '10,40' => 'Connection.open',
        '10,41' => 'Connection.open_ok',
        '10,50' => 'Connection.close',
        '10,51' => 'Connection.close_ok',
        '10,60' => 'Connection.blocked',
        '10,61' => 'Connection.unblocked',
        '20,10' => 'Channel.open',
        '20,11' => 'Channel.open_ok',
        '20,20' => 'Channel.flow',
        '20,21' => 'Channel.flow_ok',
        '20,40' => 'Channel.close',
        '20,41' => 'Channel.close_ok',
        '30,10' => 'Access.request',
        '30,11' => 'Access.request_ok',
        '40,10' => 'Exchange.declare',
        '40,11' => 'Exchange.declare_ok',
        '40,20' => 'Exchange.delete',
        '40,21' => 'Exchange.delete_ok',
        '40,30' => 'Exchange.bind',
        '40,31' => 'Exchange.bind_ok',
        '40,40' => 'Exchange.unbind',
        '40,51' => 'Exchange.unbind_ok',
        '50,10' => 'Queue.declare',
        '50,11' => 'Queue.declare_ok',
        '50,20' => 'Queue.bind',
        '50,21' => 'Queue.bind_ok',
        '50,30' => 'Queue.purge',
        '50,31' => 'Queue.purge_ok',
        '50,40' => 'Queue.delete',
        '50,41' => 'Queue.delete_ok',
        '50,50' => 'Queue.unbind',
        '50,51' => 'Queue.unbind_ok',
        '60,10' => 'Basic.qos',
        '60,11' => 'Basic.qos_ok',
        '60,20' => 'Basic.consume',
        '60,21' => 'Basic.consume_ok',
        '60,30' => 'Basic.cancel',
        '60,31' => 'Basic.cancel_ok',
        '60,40' => 'Basic.publish',
        '60,50' => 'Basic.return',
        '60,60' => 'Basic.deliver',
        '60,70' => 'Basic.get',
        '60,71' => 'Basic.get_ok',
        '60,72' => 'Basic.get_empty',
        '60,80' => 'Basic.ack',
        '60,90' => 'Basic.reject',
        '60,100' => 'Basic.recover_async',
        '60,110' => 'Basic.recover',
        '60,111' => 'Basic.recover_ok',
        '60,120' => 'Basic.nack',
        '90,10' => 'Tx.select',
        '90,11' => 'Tx.select_ok',
        '90,20' => 'Tx.commit',
        '90,21' => 'Tx.commit_ok',
        '90,30' => 'Tx.rollback',
        '90,31' => 'Tx.rollback_ok',
        '85,10' => 'Confirm.select',
        '85,11' => 'Confirm.select_ok',
    );

}
