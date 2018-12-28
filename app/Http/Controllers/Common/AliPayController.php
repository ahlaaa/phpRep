<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/3/15
 * Time: 15:46
 */

namespace App\Http\Controllers\Common;
use App\Repositories\AccountFlowRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use EasyWeChat;
use Log;
use Yansongda\Pay\Pay;

class AliPayController extends BaseController
{
    public function transfer()
    {
        $config = [
            'app_id' => '2018032302433867',
            'notify_url' => 'https://bzf.15dk.top/alipay.notify',
            'return_url' => 'https://bzf.15dk.top/alipay.return',
            //'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlKRFPM8uX4ipwwItBDm2L70L/89xS0d/k2aANYf6uQ4dqR9KP31HDyCIuIbCAkofC/kQRJntZgAzdGWHvqN1q2hvxT4yGI1EitUed8PiamGfzPAlyE2nkH2MdsjjDKZEHgazJcNpdgJn8bWbuQK1ahwDho6rXlqEXuY5qRkDW1oQC/pU98hTwbo/qzEvvNOKe17QxnrMB9L8wvPfdBlSKdahlv79JgZM34GT9hFReCia+ZsscWFJHMqCYnR8ddthf0/WwD7qcmOWohWg1mGqn/J7qFwBYsTWPEXmPwE9vLk59no5xHYrGezswZIzQ3mLhYRbv31x9Pj4BoRZ8mmJRQIDAQAB',
            'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtpxKZS1kiyx6LVWQmq2i0Pn63OB0IQyDNnQvSShguvp9YpZWOOCwv5hDTWI30TQg6w9rbYu76y9JQIZFB2X6ObxBApI1zXThPh2r9D8NWkgB3aWhB7j2x8TFRZnJ0+pLQOpr2FFT94iB7UXOIK2ZWMHbOsdRMd45RzrUU6QAkOJ4953znPKSWFbLiOfFuw48bCkh4/jI3Nrc6eDiotI8dWtnxJyvNjtyrqs44P0u169fVz3FtqQdlbpN2VP61lUc9hKV43K1RbAJvXGhsFj0uJG48pl8+T9DpBYEGdDzbR1/ZHR6O1072+Nz+UjvhhS+Mnb1YPuyzf4Hki3mhn7Z8wIDAQAB',
//            'private_key' => 'MIIEowIBAAKCAQEAtpxKZS1kiyx6LVWQmq2i0Pn63OB0IQyDNnQvSShguvp9YpZW
//OOCwv5hDTWI30TQg6w9rbYu76y9JQIZFB2X6ObxBApI1zXThPh2r9D8NWkgB3aWh
//B7j2x8TFRZnJ0+pLQOpr2FFT94iB7UXOIK2ZWMHbOsdRMd45RzrUU6QAkOJ4953z
//nPKSWFbLiOfFuw48bCkh4/jI3Nrc6eDiotI8dWtnxJyvNjtyrqs44P0u169fVz3F
//tqQdlbpN2VP61lUc9hKV43K1RbAJvXGhsFj0uJG48pl8+T9DpBYEGdDzbR1/ZHR6
//O1072+Nz+UjvhhS+Mnb1YPuyzf4Hki3mhn7Z8wIDAQABAoIBAHoZTnUQQOX9u0OM
//rr990hvAycfeHEfswd8rGGLmKKdczXGZ69TkB8pT2MxpG8E6Bbil+sKoZ+H9IBGQ
//tZ8YxJLOGPnLIUZbHDAYTt1lO1xeQUEeeelb90Xjf7Pl/FlBk0e4dpuQ5X/hOl6Y
//Chc3fA0osZk/pD6fw9SotUenpOk6I1i2+8NNQ7E1bZpakP0U1SH+/nCt8BXS+aqq
//hT5J/uOkxnZjMgMNF3JbwSMBQzvfXKODQZ78+fzPkTqrIGOt/9H7x2CDMSfdclbc
//Sc3FkXesCx/2fvC0oSD2/o+A/+FyMf8ChnBdbS0f52uAOqJuCed/PT7bi16lg454
//raofjaECgYEA2ng7P9ZxeUgDzyD6E6Zdni1rMNNL6VXeg+f5toaHddkgc2woI2dj
//Q0ICzdmxOi4sTYtoGvAsAVw13SvEd2vuNKdZ4/ZTF8nttoA7VWhJEoX+vLsx9FwE
//cgLhhBGGPMwkC8t02MxZ4a+WOIBpBMTYhcwC6BEGhAer1+NDha2FZ4cCgYEA1fsP
//fB9ATay+xIKdOA2xMH2sD/XAtVlOX5xvyLhlnoA6uXxQ4jv6020zNJxlXgvylIZ0
//ZsiglBf/glrPsDJB3x+07L4dYqu+DypWqMLjvsmMTxSZemkw5mUT4Xa1snpzh+vK
//G9Hul5fuDMklnLxe5Z7hkzNZrUcrN+i0O6zw/TUCgYBjLrxvYfLIRdp82ZLPAvNz
//kVkdpH/NIg/QQKuMowyygu2JmSurzw8whLJzNAaSzE2OsuCDgk/oGi3WCD28ncJa
//IzPbG4Rjw2fpN9Q4FQ0/nJempTGrp27ZN9ecNryDs4YV2LtmhXe0zxta8Wk8IgXO
//0GztYHVd0YHBlEqeUMXE1wKBgALZsk4b+HZQa8YgW0nI3OhhdC5OPr/rraCWa+LH
//mgrveFjKMCWjWOcCGGGGB8+l5xhVZi2MVJ9EZpHs9cFKGhiHypgwvCF5WjHHhZn/
//5pq/ApB3HMhFqHIZPJePRkJXYTyZRnryY/Q/ANvIviiFVdpHMIgOcg5d2VSIVAZL
//enZVAoGBAJAgnqbsMc6uNMZSIfudDTaISsxpufUug3NIdO05b+0uZxXS0ShiVZ59
//CvVdyOqXVL4KhjZ4IK/EjHKmGzybKQ4nZLTIEHehTvKCCh5OerggV8NqKxUToZpy
//MOv7QQz1riUX7Lt1H+9stw2ByzHl0WMhVA2TbtwUFGJaRE/lqVo9',
            'private_key' => 'MIIEowIBAAKCAQEAtpxKZS1kiyx6LVWQmq2i0Pn63OB0IQyDNnQvSShguvp9YpZWOOCwv5hDTWI30TQg6w9rbYu76y9JQIZFB2X6ObxBApI1zXThPh2r9D8NWkgB3aWhB7j2x8TFRZnJ0+pLQOpr2FFT94iB7UXOIK2ZWMHbOsdRMd45RzrUU6QAkOJ4953znPKSWFbLiOfFuw48bCkh4/jI3Nrc6eDiotI8dWtnxJyvNjtyrqs44P0u169fVz3FtqQdlbpN2VP61lUc9hKV43K1RbAJvXGhsFj0uJG48pl8+T9DpBYEGdDzbR1/ZHR6O1072+Nz+UjvhhS+Mnb1YPuyzf4Hki3mhn7Z8wIDAQABAoIBAHoZTnUQQOX9u0OMrr990hvAycfeHEfswd8rGGLmKKdczXGZ69TkB8pT2MxpG8E6Bbil+sKoZ+H9IBGQtZ8YxJLOGPnLIUZbHDAYTt1lO1xeQUEeeelb90Xjf7Pl/FlBk0e4dpuQ5X/hOl6YChc3fA0osZk/pD6fw9SotUenpOk6I1i2+8NNQ7E1bZpakP0U1SH+/nCt8BXS+aqqhT5J/uOkxnZjMgMNF3JbwSMBQzvfXKODQZ78+fzPkTqrIGOt/9H7x2CDMSfdclbcSc3FkXesCx/2fvC0oSD2/o+A/+FyMf8ChnBdbS0f52uAOqJuCed/PT7bi16lg454raofjaECgYEA2ng7P9ZxeUgDzyD6E6Zdni1rMNNL6VXeg+f5toaHddkgc2woI2djQ0ICzdmxOi4sTYtoGvAsAVw13SvEd2vuNKdZ4/ZTF8nttoA7VWhJEoX+vLsx9FwEcgLhhBGGPMwkC8t02MxZ4a+WOIBpBMTYhcwC6BEGhAer1+NDha2FZ4cCgYEA1fsPfB9ATay+xIKdOA2xMH2sD/XAtVlOX5xvyLhlnoA6uXxQ4jv6020zNJxlXgvylIZ0ZsiglBf/glrPsDJB3x+07L4dYqu+DypWqMLjvsmMTxSZemkw5mUT4Xa1snpzh+vKG9Hul5fuDMklnLxe5Z7hkzNZrUcrN+i0O6zw/TUCgYBjLrxvYfLIRdp82ZLPAvNzkVkdpH/NIg/QQKuMowyygu2JmSurzw8whLJzNAaSzE2OsuCDgk/oGi3WCD28ncJaIzPbG4Rjw2fpN9Q4FQ0/nJempTGrp27ZN9ecNryDs4YV2LtmhXe0zxta8Wk8IgXO0GztYHVd0YHBlEqeUMXE1wKBgALZsk4b+HZQa8YgW0nI3OhhdC5OPr/rraCWa+LHmgrveFjKMCWjWOcCGGGGB8+l5xhVZi2MVJ9EZpHs9cFKGhiHypgwvCF5WjHHhZn/5pq/ApB3HMhFqHIZPJePRkJXYTyZRnryY/Q/ANvIviiFVdpHMIgOcg5d2VSIVAZLenZVAoGBAJAgnqbsMc6uNMZSIfudDTaISsxpufUug3NIdO05b+0uZxXS0ShiVZ59CvVdyOqXVL4KhjZ4IK/EjHKmGzybKQ4nZLTIEHehTvKCCh5OerggV8NqKxUToZpyMOv7QQz1riUX7Lt1H+9stw2ByzHl0WMhVA2TbtwUFGJaRE/lqVo9',
            'log' => [ // optional
                'file' => storage_path('/logs/alipay.log'),
                'level' => 'debug'
            ],
            //'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
        ];

        $order = [
            'out_biz_no' => time(),
            'payee_type' => 'ALIPAY_LOGONID',
            'payee_account' => 'hohohuangming@sina.com',
            'amount' => '0.01',
        ];

        return Pay::alipay($config)->transfer($order);
    }

    public function notify()
    {
        
    }

    public function return()
    {
        
    }
}