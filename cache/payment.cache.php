<?php
return unserialize('a:5:{s:7:"balance";a:6:{s:10:"payment_id";s:1:"1";s:12:"payment_name";s:12:"余额支付";s:12:"payment_type";s:7:"balance";s:12:"payment_desc";s:54:"使用帐户余额支付，只有会员才能使用。";s:14:"payment_config";b:0;s:13:"payment_state";s:1:"1";}s:6:"alipay";a:6:{s:10:"payment_id";s:1:"6";s:12:"payment_name";s:9:"支付宝";s:12:"payment_type";s:6:"alipay";s:12:"payment_desc";s:72:"即时到帐接口，买家交易金额直接转入卖家支付宝账户";s:14:"payment_config";a:5:{s:10:"alipay_pid";s:0:"";s:10:"alipay_key";s:0:"";s:12:"alipay_appid";s:0:"";s:17:"alipay_public_key";s:0:"";s:21:"alipay_my_private_key";s:0:"";}s:13:"payment_state";s:1:"0";}s:3:"cod";a:6:{s:10:"payment_id";s:1:"7";s:12:"payment_name";s:12:"货到付款";s:12:"payment_type";s:3:"cod";s:12:"payment_desc";s:69:"送货上门后再收款，支持现金、POS机刷卡、支票支付";s:14:"payment_config";b:0;s:13:"payment_state";s:1:"0";}s:6:"wechat";a:6:{s:10:"payment_id";s:1:"8";s:12:"payment_name";s:12:"微信支付";s:12:"payment_type";s:6:"wechat";s:12:"payment_desc";s:51:"实现微信PC扫码支付/H5支付/公众号支付";s:14:"payment_config";a:3:{s:12:"wechat_appid";s:0:"";s:12:"wechat_mchid";s:0:"";s:10:"wechat_key";s:0:"";}s:13:"payment_state";s:1:"0";}s:4:"bank";a:6:{s:10:"payment_id";s:1:"9";s:12:"payment_name";s:12:"转账汇款";s:12:"payment_type";s:4:"bank";s:12:"payment_desc";s:96:"通过线下转账汇款方式支付，汇款帐号：建设银行 621700254000005xxxx 刘某某";s:14:"payment_config";a:1:{s:9:"bank_text";s:36:"通过线下转账汇款方式支付";}s:13:"payment_state";s:1:"1";}}');
?>