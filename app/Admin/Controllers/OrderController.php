<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->filter(function($filter){

		    // 去掉默认的id过滤器
		    $filter->disableIdFilter();
		    $filter->like('remark','标识');
			$filter->like('account','账号');
		    // 在这里添加字段过滤器
		    $filter->equal('country_code','国家')->select(["002"=>"Aaland Islands","001"=>"Afghanistan ","003"=>"Albania","005"=>"Algeria","007"=>"American Samoa","008"=>"Andorra","010"=>"Angola","011"=>"Anguilla","009"=>"Antarctica","012"=>"Antigua and Barbuda","015"=>"Argentina","016"=>"Armenia","017"=>"Aruba","020"=>"Australia","025"=>"Austria","029"=>"Azerbaijan","035"=>"Bahamas","040"=>"Bahrain","045"=>"Bangladesh","050"=>"Barbados","094"=>"Belarus","055"=>"Belgium","056"=>"Belize","058"=>"Benin","060"=>"Bermuda","063"=>"Bhutan","065"=>"Bolivia","660"=>"Bonaire, Sint Eustasius, and Saba","069"=>"Bosnia and Herzegovina","070"=>"Botswana","661"=>"Bouvet Island","075"=>"Brazil","662"=>"British Indian Ocean Territory","081"=>"Brunei Darussalam","085"=>"Bulgaria","593"=>"Burkina Faso","092"=>"Burundi","307"=>"Cambodia","095"=>"Cameroon","650"=>"Canada - Alberta","651"=>"Canada - British Columbia","653"=>"Canada - Manitoba","654"=>"Canada - New Brunswick","643"=>"Canada - Newfoundland and Labrador","644"=>"Canada - Northwest Territory","645"=>"Canada - Nova Scotia","652"=>"Canada - Nunavut","646"=>"Canada - Ontario","647"=>"Canada - Prince Edward Island","648"=>"Canada - Quebec","649"=>"Canada - Saskatchewan","626"=>"Canada - Yukon Territory","106"=>"Cape Verde","110"=>"Cayman Islands","113"=>"Central African Republic","114"=>"Chad","115"=>"Chile","457"=>"China","663"=>"Christmas Island","664"=>"Cocos (Keeling) Islands","120"=>"Colombia","122"=>"Comoros","125"=>"Congo","630"=>"Congo, The Democratic Republic Of The","126"=>"Cook Islands","130"=>"Costa Rica","290"=>"Cote D'Ivoire","133"=>"Croatia","135"=>"Cuba","665"=>"Curacao","140"=>"Cyprus","142"=>"Czechia","150"=>"Denmark","153"=>"Djibouti","154"=>"Dominica","155"=>"Dominican Republic","165"=>"Ecuador","170"=>"Egypt","175"=>"El Salvador","180"=>"England","183"=>"Equatorial Guinea","182"=>"Eritrea","184"=>"Estonia","185"=>"Ethiopia","666"=>"Falkland Islands (Malvinas)","187"=>"Faroe Islands","190"=>"Fiji","195"=>"Finland","200"=>"France","203"=>"French Guiana","202"=>"French Polynesia","667"=>"French Southern Territories","204"=>"Gabon ","205"=>"Gambia","208"=>"Georgia","210"=>"Germany","215"=>"Ghana","217"=>"Gibraltar","220"=>"Greece","225"=>"Greenland","227"=>"Grenada","228"=>"Guadeloupe","229"=>"Guam","230"=>"Guatemala","668"=>"Guernsey","233"=>"Guinea","234"=>"Guinea-Bissau","235"=>"Guyana","240"=>"Haiti","669"=>"Heard Island and Mcdonald Islands","597"=>"Holy See (Vatican City State)","245"=>"Honduras","250"=>"Hong Kong","251"=>"Hungary","255"=>"Iceland","260"=>"India","265"=>"Indonesia","270"=>"Iran, Islamic Republic Of","273"=>"Iraq","275"=>"Ireland","277"=>"Isle Of Man","280"=>"Israel","285"=>"Italy","295"=>"Jamaica","300"=>"Japan","670"=>"Jersey","305"=>"Jordan","308"=>"Kazakhstan","310"=>"Kenya","312"=>"Kiribati","314"=>"Korea, North (DPR)","315"=>"Korea, South (ROK)","686"=>"Kosovo","320"=>"Kuwait","323"=>"Kyrgyzstan","325"=>"Lao People's Democratic Republic ","328"=>"Latvia","330"=>"Lebanon","333"=>"Lesotho","335"=>"Liberia","340"=>"Libya","343"=>"Liechtenstein","344"=>"Lithuania","345"=>"Luxembourg","347"=>"Macao","348"=>"Macedonia, The Former Yugoslav Republic Of","350"=>"Madagascar","355"=>"Malawi","360"=>"Malaysia","361"=>"Maldives","363"=>"Mali","365"=>"Malta","368"=>"Marshall Islands","366"=>"Martinique","369"=>"Mauritania","370"=>"Mauritius","671"=>"Mayotte","375"=>"Mexico","107"=>"Micronesia, Federated States Of","376"=>"Moldova, Republic Of","378"=>"Monaco","379"=>"Mongolia","383"=>"Montenegro","381"=>"Montserrat","380"=>"Morocco","385"=>"Mozambique","090"=>"Myanmar","388"=>"Namibia","386"=>"Nauru","387"=>"Nepal","390"=>"Netherlands","396"=>"New Caledonia","405"=>"New Zealand","420"=>"Nicaragua","425"=>"Niger","430"=>"Nigeria","433"=>"Niue","672"=>"Norfolk Island","434"=>"Northern Ireland","367"=>"Northern Mariana Islands","435"=>"Norway","443"=>"Oman","445"=>"Pakistan","447"=>"Palau","611"=>"Palestine, State of","450"=>"Panama","400"=>"Papua New Guinea","455"=>"Paraguay","460"=>"Peru","465"=>"Philippines","673"=>"Pitcairn","470"=>"Poland","475"=>"Portugal","477"=>"Qatar","482"=>"Reunion","483"=>"Romania","484"=>"Russian Federation","487"=>"Rwanda","674"=>"Saint Barthelemy","675"=>"Saint Helena, Ascension and Tristan da Cunha","486"=>"Saint Kitts and Nevis","521"=>"Saint Lucia","676"=>"Saint Martin (French Part)","677"=>"Saint Pierre and Miquelon","522"=>"Saint Vincent and The Grenadines","620"=>"Samoa","488"=>"San Marino","489"=>"Sao Tome and Principe","490"=>"Saudi Arabia","495"=>"Scotland","497"=>"Senegal","499"=>"Serbia","498"=>"Seychelles","500"=>"Sierra Leone","505"=>"Singapore","678"=>"Sint Maarten (Dutch Part)","503"=>"Slovakia","504"=>"Slovenia","506"=>"Solomon Islands","507"=>"Somalia","510"=>"South Africa","679"=>"South Georgia and The South Sandwich Islands","685"=>"South Sudan","515"=>"Spain","520"=>"Sri Lanka","525"=>"Sudan","527"=>"Suriname","680"=>"Svalbard and Jan Mayen","530"=>"Swaziland","535"=>"Sweden","540"=>"Switzerland","545"=>"Syrian Arab Republic","555"=>"Taiwan","556"=>"Tajikistan","560"=>"Tanzania, United Republic Of","565"=>"Thailand","681"=>"Timor-Leste","567"=>"Togo","682"=>"Tokelau","570"=>"Tonga","575"=>"Trinidad and Tobago","580"=>"Tunisia","585"=>"Turkey","584"=>"Turkmenistan","586"=>"Turks and Caicos Islands","587"=>"Tuvalu","590"=>"Uganda","589"=>"Ukraine","591"=>"United Arab Emirates","595"=>"Uruguay","594"=>"Uzbekistan","596"=>"Vanuatu","600"=>"Venezuela","605"=>"Viet Nam","077"=>"Virgin Islands, British","607"=>"Virgin Islands, U.S.","610"=>"Wales","683"=>"Wallis and Futuna","684"=>"Western Sahara","623"=>"Yemen","635"=>"Zambia","480"=>"Zimbabwe",]);
		    $filter->like('city_name','城市名字');
			$filter->equal('test_time','考试时间')->datetime(['format' => 'YYYYMM']);
		});
        //$grid->column('id', __('Id'));
        $grid->column('remark', __('标识'));
        $grid->column('account', __('账号'));
        $grid->column('password', __('密码'));
        $grid->column('country_code', __('国家编码'));
        $grid->column('country_name', __('国家名字'));
        //$grid->column('city_code', __('城市编码'));
        $grid->column('city_name', __('城市名字'));
        $grid->column('center_code', __('考场编码'));
        $grid->column('test_time', __('考试时间'));
        $grid->column('status', __('状态'));
        // $grid->column('card_num', __('支付卡号'));
        // $grid->column('card_type', __('卡类型'));
        // $grid->column('card_security', __('卡安全码'));
        // $grid->column('card_expire_month', __('卡过期月份'));
        // $grid->column('card_expire_year', __('卡过期年份'));
        //$grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('account', __('账号'));
        $show->field('password', __('密码'));
        $show->field('country_code', __('国家编码'));
        $show->field('country_name', __('国家名字'));
        $show->field('city_code', __('城市编码'));
        $show->field('city_name', __('城市名字'));
        $show->field('center_code', __('考场编码'));
        $show->field('test_time', __('考试时间'));
        // $show->field('card_num', __('卡号'));
        // $show->field('card_type', __('卡类型'));
        // $show->field('card_security', __('卡安全码'));
        // $show->field('card_expire_month', __('卡有效期月份'));
        // $show->field('card_expire_year', __('卡有效期年份'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
    	$countryArr = ["002"=>"Aaland Islands","001"=>"Afghanistan ","003"=>"Albania","005"=>"Algeria","007"=>"American Samoa","008"=>"Andorra","010"=>"Angola","011"=>"Anguilla","009"=>"Antarctica","012"=>"Antigua and Barbuda","015"=>"Argentina","016"=>"Armenia","017"=>"Aruba","020"=>"Australia","025"=>"Austria","029"=>"Azerbaijan","035"=>"Bahamas","040"=>"Bahrain","045"=>"Bangladesh","050"=>"Barbados","094"=>"Belarus","055"=>"Belgium","056"=>"Belize","058"=>"Benin","060"=>"Bermuda","063"=>"Bhutan","065"=>"Bolivia","660"=>"Bonaire, Sint Eustasius, and Saba","069"=>"Bosnia and Herzegovina","070"=>"Botswana","661"=>"Bouvet Island","075"=>"Brazil","662"=>"British Indian Ocean Territory","081"=>"Brunei Darussalam","085"=>"Bulgaria","593"=>"Burkina Faso","092"=>"Burundi","307"=>"Cambodia","095"=>"Cameroon","650"=>"Canada - Alberta","651"=>"Canada - British Columbia","653"=>"Canada - Manitoba","654"=>"Canada - New Brunswick","643"=>"Canada - Newfoundland and Labrador","644"=>"Canada - Northwest Territory","645"=>"Canada - Nova Scotia","652"=>"Canada - Nunavut","646"=>"Canada - Ontario","647"=>"Canada - Prince Edward Island","648"=>"Canada - Quebec","649"=>"Canada - Saskatchewan","626"=>"Canada - Yukon Territory","106"=>"Cape Verde","110"=>"Cayman Islands","113"=>"Central African Republic","114"=>"Chad","115"=>"Chile","457"=>"China","663"=>"Christmas Island","664"=>"Cocos (Keeling) Islands","120"=>"Colombia","122"=>"Comoros","125"=>"Congo","630"=>"Congo, The Democratic Republic Of The","126"=>"Cook Islands","130"=>"Costa Rica","290"=>"Cote D'Ivoire","133"=>"Croatia","135"=>"Cuba","665"=>"Curacao","140"=>"Cyprus","142"=>"Czechia","150"=>"Denmark","153"=>"Djibouti","154"=>"Dominica","155"=>"Dominican Republic","165"=>"Ecuador","170"=>"Egypt","175"=>"El Salvador","180"=>"England","183"=>"Equatorial Guinea","182"=>"Eritrea","184"=>"Estonia","185"=>"Ethiopia","666"=>"Falkland Islands (Malvinas)","187"=>"Faroe Islands","190"=>"Fiji","195"=>"Finland","200"=>"France","203"=>"French Guiana","202"=>"French Polynesia","667"=>"French Southern Territories","204"=>"Gabon ","205"=>"Gambia","208"=>"Georgia","210"=>"Germany","215"=>"Ghana","217"=>"Gibraltar","220"=>"Greece","225"=>"Greenland","227"=>"Grenada","228"=>"Guadeloupe","229"=>"Guam","230"=>"Guatemala","668"=>"Guernsey","233"=>"Guinea","234"=>"Guinea-Bissau","235"=>"Guyana","240"=>"Haiti","669"=>"Heard Island and Mcdonald Islands","597"=>"Holy See (Vatican City State)","245"=>"Honduras","250"=>"Hong Kong","251"=>"Hungary","255"=>"Iceland","260"=>"India","265"=>"Indonesia","270"=>"Iran, Islamic Republic Of","273"=>"Iraq","275"=>"Ireland","277"=>"Isle Of Man","280"=>"Israel","285"=>"Italy","295"=>"Jamaica","300"=>"Japan","670"=>"Jersey","305"=>"Jordan","308"=>"Kazakhstan","310"=>"Kenya","312"=>"Kiribati","314"=>"Korea, North (DPR)","315"=>"Korea, South (ROK)","686"=>"Kosovo","320"=>"Kuwait","323"=>"Kyrgyzstan","325"=>"Lao People's Democratic Republic ","328"=>"Latvia","330"=>"Lebanon","333"=>"Lesotho","335"=>"Liberia","340"=>"Libya","343"=>"Liechtenstein","344"=>"Lithuania","345"=>"Luxembourg","347"=>"Macao","348"=>"Macedonia, The Former Yugoslav Republic Of","350"=>"Madagascar","355"=>"Malawi","360"=>"Malaysia","361"=>"Maldives","363"=>"Mali","365"=>"Malta","368"=>"Marshall Islands","366"=>"Martinique","369"=>"Mauritania","370"=>"Mauritius","671"=>"Mayotte","375"=>"Mexico","107"=>"Micronesia, Federated States Of","376"=>"Moldova, Republic Of","378"=>"Monaco","379"=>"Mongolia","383"=>"Montenegro","381"=>"Montserrat","380"=>"Morocco","385"=>"Mozambique","090"=>"Myanmar","388"=>"Namibia","386"=>"Nauru","387"=>"Nepal","390"=>"Netherlands","396"=>"New Caledonia","405"=>"New Zealand","420"=>"Nicaragua","425"=>"Niger","430"=>"Nigeria","433"=>"Niue","672"=>"Norfolk Island","434"=>"Northern Ireland","367"=>"Northern Mariana Islands","435"=>"Norway","443"=>"Oman","445"=>"Pakistan","447"=>"Palau","611"=>"Palestine, State of","450"=>"Panama","400"=>"Papua New Guinea","455"=>"Paraguay","460"=>"Peru","465"=>"Philippines","673"=>"Pitcairn","470"=>"Poland","475"=>"Portugal","477"=>"Qatar","482"=>"Reunion","483"=>"Romania","484"=>"Russian Federation","487"=>"Rwanda","674"=>"Saint Barthelemy","675"=>"Saint Helena, Ascension and Tristan da Cunha","486"=>"Saint Kitts and Nevis","521"=>"Saint Lucia","676"=>"Saint Martin (French Part)","677"=>"Saint Pierre and Miquelon","522"=>"Saint Vincent and The Grenadines","620"=>"Samoa","488"=>"San Marino","489"=>"Sao Tome and Principe","490"=>"Saudi Arabia","495"=>"Scotland","497"=>"Senegal","499"=>"Serbia","498"=>"Seychelles","500"=>"Sierra Leone","505"=>"Singapore","678"=>"Sint Maarten (Dutch Part)","503"=>"Slovakia","504"=>"Slovenia","506"=>"Solomon Islands","507"=>"Somalia","510"=>"South Africa","679"=>"South Georgia and The South Sandwich Islands","685"=>"South Sudan","515"=>"Spain","520"=>"Sri Lanka","525"=>"Sudan","527"=>"Suriname","680"=>"Svalbard and Jan Mayen","530"=>"Swaziland","535"=>"Sweden","540"=>"Switzerland","545"=>"Syrian Arab Republic","555"=>"Taiwan","556"=>"Tajikistan","560"=>"Tanzania, United Republic Of","565"=>"Thailand","681"=>"Timor-Leste","567"=>"Togo","682"=>"Tokelau","570"=>"Tonga","575"=>"Trinidad and Tobago","580"=>"Tunisia","585"=>"Turkey","584"=>"Turkmenistan","586"=>"Turks and Caicos Islands","587"=>"Tuvalu","590"=>"Uganda","589"=>"Ukraine","591"=>"United Arab Emirates","595"=>"Uruguay","594"=>"Uzbekistan","596"=>"Vanuatu","600"=>"Venezuela","605"=>"Viet Nam","077"=>"Virgin Islands, British","607"=>"Virgin Islands, U.S.","610"=>"Wales","683"=>"Wallis and Futuna","684"=>"Western Sahara","623"=>"Yemen","635"=>"Zambia","480"=>"Zimbabwe",];
        $form = new Form(new Order());
		$form->text('remark', __('标识'))->rules('required');
        $form->text('account', __('账号'))->rules('required');
        $form->text('password', __('密码'))->rules('required');
        $form->select('country_code', __('国家'))->options($countryArr);
        // $form->text('country_code', __('国家编码'));
        // $form->text('country_name', __('国家名字'));
        // $form->text('city_code', __('城市编码'));
        $form->hidden('country_name');
        $form->text('city_name', __('城市名字'));
        $form->text('center_code', __('考场编码'));
        $form->datetime('test_time','考试时间')->format('YYYYMM');
        $form->text('status', __('状态'));
        // $form->text('card_num', __('卡号'));
        // $form->text('card_type', __('卡类型'));
        // $form->text('card_security', __('卡安全码'));
        // $form->select('card_expire_month', __('卡有效期月份'))->options(['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December']);
        // $yearArr = [];
        // for($i=20;$i<=49;$i++){
        // 	$yearArr[$i] = '20'.$i;
        // }
        // $form->select('card_expire_year', __('卡有效期年份'))->options($yearArr);
		$form->saving(function (Form $form) use ($countryArr) {
			if($form->country_code){
				$form->country_name = $countryArr[$form->country_code];
			}
		});
        return $form;
    }
}
