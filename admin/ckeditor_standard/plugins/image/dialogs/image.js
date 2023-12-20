/*
 Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
(function(){var u=function(d,k){function u(){var a=arguments,b=this.getContentElement("advanced","txtdlgGenStyle");b&&b.commit.apply(b,a);this.foreach(function(b){b.commit&&"txtdlgGenStyle"!=b.id&&b.commit.apply(b,a)})}function g(a){if(!v){v=1;var b=this.getDialog(),c=b.imageElement;if(c){this.commit(1,c);a=[].concat(a);for(var d=a.length,h,e=0;e<d;e++)(h=b.getContentElement.apply(b,a[e].split(":")))&&h.setup(1,c)}v=0}}var l=/^\s*(\d+)((px)|\%)?\s*$/i,y=/(^\s*(\d+)((px)|\%)?\s*$)|^$/i,q=/^\d+px$/,
z=function(){var a=this.getValue(),b=this.getDialog(),c=a.match(l);c&&("%"==c[2]&&m(b,!1),a=c[1]);b.lockRatio&&(c=b.originalElement,"true"==c.getCustomData("isReady")&&("txtHeight"==this.id?(a&&"0"!=a&&(a=Math.round(a/c.$.height*c.$.width)),isNaN(a)||b.setValueOf("info","txtWidth",a)):(a&&"0"!=a&&(a=Math.round(a/c.$.width*c.$.height)),isNaN(a)||b.setValueOf("info","txtHeight",a))));e(b)},e=function(a){if(!a.originalElement||!a.preview)return 1;a.commitContent(4,a.preview);return 0},v,m=function(a,
b){if(!a.getContentElement("info","ratioLock"))return null;var c=a.originalElement;if(!c)return null;if("check"==b){if(!a.userlockRatio&&"true"==c.getCustomData("isReady")){var d=a.getValueOf("info","txtWidth"),h=a.getValueOf("info","txtHeight"),c=c.$.width/c.$.height,e=d/h;a.lockRatio=!1;d||h?1==Math.round(c/e*100)/100&&(a.lockRatio=!0):a.lockRatio=!0}}else void 0!==b?a.lockRatio=b:(a.userlockRatio=1,a.lockRatio=!a.lockRatio);d=CKEDITOR.document.getById(r);a.lockRatio?d.removeClass("cke_btn_unlocked"):
d.addClass("cke_btn_unlocked");d.setAttribute("aria-checked",a.lockRatio);CKEDITOR.env.hc&&d.getChild(0).setHtml(a.lockRatio?CKEDITOR.env.ie?"■":"▣":CKEDITOR.env.ie?"□":"▢");return a.lockRatio},A=function(a,b){var c=a.originalElement;if("true"==c.getCustomData("isReady")){var d=a.getContentElement("info","txtWidth"),h=a.getContentElement("info","txtHeight"),f;b?c=f=0:(f=c.$.width,c=c.$.height);d&&d.setValue(f);h&&h.setValue(c)}e(a)},B=function(a,b){function c(a,b){var c=a.match(l);return c?("%"==
c[2]&&(c[1]+="%",m(d,!1)),c[1]):b}if(1==a){var d=this.getDialog(),e="",f="txtWidth"==this.id?"width":"height",g=b.getAttribute(f);g&&(e=c(g,e));e=c(b.getStyle(f),e);this.setValue(e)}},w,t=function(){var a=this.originalElement,b=CKEDITOR.document.getById(n);a.setCustomData("isReady","true");a.removeListener("load",t);a.removeListener("error",f);a.removeListener("abort",f);b&&b.setStyle("display","none");this.dontResetSize||A(this,!1===d.config.image_prefillDimensions);this.firstLoad&&CKEDITOR.tools.setTimeout(function(){m(this,
"check")},0,this);this.dontResetSize=this.firstLoad=!1;e(this)},f=function(){var a=this.originalElement,b=CKEDITOR.document.getById(n);a.removeListener("load",t);a.removeListener("error",f);a.removeListener("abort",f);a=CKEDITOR.getUrl(CKEDITOR.plugins.get("image").path+"images/noimage.png");this.preview&&this.preview.setAttribute("src",a);b&&b.setStyle("display","none");m(this,!1)},p=function(a){return CKEDITOR.tools.getNextId()+"_"+a},r=p("btnLockSizes"),x=p("btnResetSize"),n=p("ImagePreviewLoader"),
D=p("previewLink"),C=p("previewImage");return{title:d.lang.image["image"==k?"title":"titleButton"],minWidth:"moono-lisa"==(CKEDITOR.skinName||d.config.skin)?500:420,minHeight:360,getModel:function(a){var b=(a=a.getSelection().getSelectedElement())&&"img"===a.getName(),c=a&&"input"===a.getName()&&"image"===a.getAttribute("type");return b||c?a:null},onShow:function(){this.linkEditMode=this.imageEditMode=this.linkElement=this.imageElement=!1;this.lockRatio=!0;this.userlockRatio=0;this.dontResetSize=
!1;this.firstLoad=!0;this.addLink=!1;var a=this.getParentEditor(),b=a.getSelection(),c=(b=b&&b.getSelectedElement())&&a.elementPath(b).contains("a",1),d=CKEDITOR.document.getById(n);d&&d.setStyle("display","none");w=new CKEDITOR.dom.element("img",a.document);this.preview=CKEDITOR.document.getById(C);this.originalElement=a.document.createElement("img");this.o N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0�g	� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 5 5 2 1 8 6 9 4 0 2 4 0 6 1 5 6 2 2, 8 : o r g i d : 7 7 7 3 5 5 0 0 - b 9 4 6 - 4 a a d - 9 e 6 b - f b 5 e f 4 6 f 0 d 5 1 < 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0���%< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0    2� ��������
�
� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0�d	    2� ��������
�
� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 5 5 2 1 8 6 9 4 0 2 4 0 6 1 5 6 2 2, 8 : o r g i d : 7 7 7 3 5 5 0 0 - b 9 4 6 - 4 a a d - 9 e 6 b - f b 5 e f 4 6 f 0 d 5 1 < 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0���%< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 7 8 5 2 0�G�����         %  2�g	� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3���%��o"conversationId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"id"1630048188143"
sequenceIdI�"creator",8:orgid:a0b739b7-8d46-4f9b-a2b6-6a47ff55ba7d"idUnion"1630048187324"parentMessageId"1630036264727"version"1630048188143{    2� �������

 %  2�g	    2� �������
�
� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3���%��o"conversationId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"id"1630048188143"
sequenceIdI�"creator",8:orgid:a0b739b7-8d46-4f9b-a2b6-6a47ff55ba7d"idUnion"1630048187324"parentMessageId"1630036264727"version"1630048188143{[������        � %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3�g	� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 7 3 2 4, 8 : o r g i d : a 0 b 7 3 9 b 7 - 8 d 4 6 - 4 f 9 b - a 2 b 6 - 6 a 4 7 f f 5 5 b a 7 d < 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3���%< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3    2� �������
�
� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3�d	    2� �������
�
� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 7 3 2 4, 8 : o r g i d : a 0 b 7 3 9 b 7 - 8 d 4 6 - 4 f 9 b - a 2 b 6 - 6 a 4 7 f f 5 5 b a 7 d < 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3���%< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 8 8 1 4 3��0����         %  2�g	� %< 1 9 : 8 7 H 6 p q W k L m h P S u H Y r W F Y K 6 N z A i K - 5 h V j 1 I 0 l j r O u r 2 E 1 @ t h r e a d . t a c v 2 1 6 3 0 0 4 8 1 9 2 2 9 0���%��o)?(b.data("cke-saved-src",this.getValue()),b.setAttribute("src",this.getValue())):8==a&&(b.setAttribute("src",""),b.removeAttribute("src"))},validate:CKEDITOR.dialog.validate.notEmpty(d.lang.image.urlMissing)},
{type:"button",id:"browse",style:"display:inline-block;margin-top:14px;",align:"center",label:d.lang.common.browseServer,hidden:!0,filebrowser:"info:txtUrl"}]}]},{id:"txtAlt",type:"text",label:d.lang.image.alt,accessKey:"T","default":"",onChange:function(){e(this.getDialog())},setup:function(a,b){1==a&&this.setValue(b.getAttribute("alt"))},commit:function(a,b){1==a?(this.getValue()||this.isChanged())&&b.setAttribute("alt",this.getValue()):4==a?b.setAttribute("alt",this.getValue()):8==a&&b.removeAttribute("alt")}},
{type:"hbox",children:[{id:"basic",type:"vbox",children:[{type:"hbox",requiredContent:"img{width,height}",widths:["50%","50%"],children:[{type:"vbox",padding:1,children:[{type:"text",width:"45px",id:"txtWidth",label:d.lang.common.width,onKeyUp:z,onChange:function(){g.call(this,"advanced:txtdlgGenStyle")},validate:function(){var a=this.getValue().match(y);(a=!(!a||0===parseInt(a[1],10)))||alert(d.lang.common.invalidLength.replace("%1",d.lang.common.width).replace("%2","px, %"));return a},setup:B,commit:function(a,
b){var c=this.getValue();1==a?(c&&d.activeFilter.check("img{width,height}")?b.setStyle("width",CKEDITOR.tools.cssLength(c)):b.removeStyle("width"),b.removeAttribute("width")):4==a?c.match(l)?b.setStyle("width",CKEDITOR.tools.cssLength(c)):(c=this.getDialog().originalElement,"true"==c.getCustomData("isReady")&&b.setStyle("width",c.$.width+"px")):8==a&&(b.removeAttribute("width"),b.removeStyle("width"))}},{type:"text",id:"txtHeight",width:"45px",label:d.lang.common.height,onKeyUp:z,onChange:function(){g.call(this,
"advanced:txtdlgGenStyle")},validate:function(){var a=this.getValue().match(y);(a=!(!a||0===parseInt(a[1],10)))||alert(d.lang.common.invalidLength.replace("%1",d.lang.common.height).replace("%2","px, %"));return a},setup:B,commit:function(a,b){var c=this.getValue();1==a?(c&&d.activeFilter.check("img{width,height}")?b.setStyle("height",CKEDITOR.tools.cssLength(c)):b.removeStyle("height"),b.removeAttribute("height")):4==a?c.match(l)?b.setStyle("height",CKEDITOR.tools.cssLength(c)):(c=this.getDialog().originalElement,
"true"==c.getCustomData("isReady")&&b.setStyle("height",c.$.height+"px")):8==a&&(b.removeAttribute("height"),b.removeStyle("height"))}}]},{id:"ratioLock",type:"html",className:"cke_dialog_image_ratiolock",style:"margin-top:30px;width:40px;height:40px;",onLoad:function(){var a=CKEDITOR.document.getById(x),b=CKEDITOR.document.getById(r);a&&(a.on("click",function(a){A(this);a.data&&a.data.preventDefault()},this.getDialog()),a.on("mouseover",function(){this.addClass("cke_btn_over")},a),a.on("mouseout",
function(){this.removeClass("cke_btn_over")},a));b&&(b.on("click",function(a){m(this);var b=this.originalElement,d=this.getValueOf("info","txtWidth");"true"==b.getCustomData("isReady")&&d&&(b=b.$.height/b.$.width*d,isNaN(b)||(this.setValueOf("info","txtHeight",Math.round(b)),e(this)));a.data&&a.data.preventDefault()},this.getDialog()),b.on("mouseover",function(){this.addClass("cke_btn_over")},b),b.on("mouseout",function(){this.removeClass("cke_btn_over")},b))},html:'\x3cdiv\x3e\x3ca href\x3d"javascript:void(0)" tabindex\x3d"-1" title\x3d"'+
d.lang.image.lockRatio+'" class\x3d"cke_btn_locked" id\x3d"'+r+'" role\x3d"checkbox"\x3e\x3cspan class\x3d"cke_icon"\x3e\x3c/span\x3e\x3cspan class\x3d"cke_label"\x3e'+d.lang.image.lockRatio+'\x3c/span\x3e\x3c/a\x3e\x3ca href\x3d"javascript:void(0)" tabindex\x3d"-1" title\x3d"'+d.lang.image.resetSize+'" class\x3d"cke_btn_reset" id\x3d"'+x+'" role\x3d"button"\x3e\x3cspan class\x3d"cke_label"\x3e'+d.lang.image.resetSize+"\x3c/span\x3e\x3c/a\x3e\x3c/div\x3e"}]},{type:"vbox",padding:1,children:[{type:"text",
id:"txtBorder",requiredContent:"img{border-width}",width:"60px",label:d.lang.image.border,"default":"",onKeyUp:function(){e(this.getDialog())},onChange:function(){g.call(this,"advanced:txtdlgGenStyle")},validate:CKEDITOR.dialog.validate.integer(dj1I0ljrOur2E1@thread.tacv2"sN M	�h �aQ�wB"	h�Chain Ь?��wB"	UserId"9��b0c8aac-9236-40d6-ada8-a6b1ac249445"<mD)R N!RhRosales, John Mark"targetBi �4"count"44"m	�<Preview"More!"6 $TemplateOpA�"hasE8 1� CA-Dxto"WebhookCorrelQ�$0ffe308c-b205-4794-bedb-9078f3299fa7"N|ProcessingLatency"	1084.9488{")()�PTopic"&ATAS Virtual S=Ton 3(Aug. 26-Sep. 8)"#.; HRosterNonBotMemberC!I�".( �IsPrivateChannel"false{"s2spartnerE�<skypespaces{":,46"ev MW<"
sequenceIdI�"q�Kind"M*LLocal"composetime"FT3.4460000Z"originalar� l�3 clientA	1a�}�D7T02:47:29.555Z"c���Link"Rhttps://amer.ng.msg.teams.microsoft.com/v1/users/ME/cFs/48:from"i�Z tacts/�")�0I"idUnion"2m "�� ��ionNuATN `��9 2R 46"mm(StorageStat�isAcap8ExecuteUpdateF"~(created!�}or���+,isFromMeT"!�4HasStarredF"r���a�$stDelivery6z s�"no��<LevelI"trimmedM�Idnt" "isSanitizedT"isRich�!�  	? P�y#,isForceDele!A,isSfBGroupC]$F"callDur�� "tParticipantsMrisA $  "cachedOme.4v� b9 Utc9�_|,Recording0"$Transcript@meetingObjects0"4.� ��"	_pinS!� o!�TPinnedF{{-{"isInsid�� t��"lat:�"000}H46{;�9 0 2 0 8t�����90208R�90116�Y����2�����8.102���� �R���6f0d5c72-8483-40f7-a7ad-c8a2c78c6caa"sf	�2� Acierda,� Joril��^�lnext: hoobastank the reason�
	B
	�b55cfc1f-9b3d-42e2-a8fe-da65b1d9d9a9"a�
PrB
	$2013.3076{�
	�
	�
	i�j
	 ��
	
	10.208�
	.3 �
	 4�
	�
	�
	�
	��
	 PS�PF
	I�
	"
		O6
	} c 	or�
	�
	z�
	�
	�
	�
	
	.ez
	15�
	�
	~
	890208{       �NBR�$� L� % 4 8 : n o t i f i c a `o n s 1 6 2 9 9 6 9 8 0
�0 1~�T    ���o"conversationId"48:notifica�s"parentMessageId"1629969809601"meso":�483,8:orgid:b085a1cb-b65c-4377-9f96-58f459edd589o"HHtype"Text"content	 t $" "client7 i2� t483"imdisplayname" "
properti�,activityo" T{ replyToR"�imestamp"2021-08-26T09:23:27.486Z"
aT�[IdN  ���SB"sourceThreadId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"sN5�(N  �W�wB"	h�Chain� Ь?��wB"	UserId"5��6219bbc7-827c-44cc-aeec-15b65a25c738"ss<mD)R N!RlPerez, Patricia L J"target.j�0"count"44"-�<Preview"IRIS "6 $TemplateOpA�"hasE9 1� CAADxto"WebhookCorrelQ�$3717eeb6-fd91-4a7a-ba8b-38310d90d09f"N|ProcessingLatency"	1996.3702{")e)�PTopic"&ATAS Virtual S=Ton 3(Aug. 26-Sep. 8)"#.; HRosterNonBotMemberC!I�".( �IsPrivateChannel"false{"s2spartnerE�<skypespaces{"6-a� ed MX8"
sequenceIdI�u�Kind"M*Locala�(mposetime"F T9.6010000Z"originalar� l�3  i� A	1a�}�@7T02:47:29.554Z".��Link"Rhttps://amer.ng.msg.teams.microsoft.com/v1/users/ME/c�s/4>from"i�Z tacts/�")�(I"idUnion.���� ��ionNuATN X�: .R A mm(StorageStat�isAcap4ExecuteUpdateF�)created!�}or���+,isFromMeT"!�4HasStarredF"r���a�$stDelivery6z s�".�<LevelI"trimmedM�I n�wPisSanitizedT"isRich�!�  	? P�z#,isForceDele!A,isSfBGroupC]$F"callDur�� "tParticipantsMrisA $  "cachedOme.4v� b9 Utc9�_|,Recording0"$Transcript@meetingObjects0"4.� ��"	_pinS!� o!�TPinnedF{{-{"isInsid�� t��"lat:�"000&zP601{;�3 0 3 3 6��� ����30336R�30175�Z�� o�X�}������49.349����0�\�����4a721847-e6c4-4065-8dc8-c7580dd7b2ad"b�\Pastrana, Carlos Lemuel��^�  ��B��486141cc-d340-4717-9edb-af88ab80be92"a�
Pr>�825.45{������i�j��u���50.336��.3  ��������z����� ]�6F�I��"�	O6�} c	or����z ���������.ez�15����~�830336{       ���ж$� L� % 4 8 : n o t i f i c a Ho n s 1 6 2 9 9 6�i4 3 8 9 8��T    ���o"conversationId"48:notifications"parentMessageId"1629969943898"messageso":162�75,8:orgid:b085a1cb-b65c-4377-9f96-58f459edd589o"mesHHtype"Text"content	 t $" "client i6� p75"imdisplayname" "
properti�,activityo" T{ replyToR"�imestamp"2021-08-26T09:25:42.725Z"
aT�[IdN  ���SB"sourceThreadId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"sN M),h �x�wB"	h�Chain Ь?��wB"	UserId"5��35ec560c-3535-4070-b9c7-2127ba217576"ss<mD)R N!R�Robles, Patrick Neil Andrei"targetU:r  b�0"count"44"-�(Preview" "6 $TemplateOpA�"hasE< 1� CADDxto"WebhookCorrelQ�$0896c125-5ff4-4739-95cc-6f10acf12542"N�ProcessingLatency"	1149.0741{"s%,)�PTopic"&ATAS Virtual S=Ton 3(Aug. 26-Sep. 8)"#.; HRosterNonBotMemberC!I�".( �IsPrivateChannel"false{"s2spartnerE�<skypespaces{":098"eg M[<"
sequenceIdI�"q�Kind"M*Locala�(mposetime"F#T3.8980000Z"originalar� l�3  i� A	1a�}�@7T02:47:29.554Z".��Link"Rhttps://amer.ng.msg.teams.microsoft.com/v1/users/ME/c�s/4>from"i�Z tacts/�"")�0I"idUnion"��75�� ��ionNuATN ��x�= 2R 98"mm(StorageStat�isAcap@ExecuteUpdateF"pv,created!�}or�� b�&,isFromMeT"!�4HasStarredF"r���a�$stDelivery6z s�".�<LevelI"trimmedM�I n�zPisSanitizedT"isRich�!�  	? P�}#,isForceDele!A,isSfBGroupC]$F"callDur�� "tParticipantsMrisA $  "cachedOme.4v� b9 Utc9�_|,Recording0"$Transcript@meetingObjects0"4.� ��"	_pinS!� o!�TPinnedF{{-{"isInsid�� t��"lat:�"000} 98{;�5		6 2��� ����51662"mso""�51508�]����2�����50.683Z"����p|z�����dcfd54f2-4d4c-4550-a567-cca5dec2b291"b�DBalagulan, Aldrin��� 5B�@PWEDI PO KUMANTA��B��538ee2d8-29eb-4c27-abfe-6705a5f7a845"a�
Pr>�$825.4652{������i�j� ����51.662��.3  ��������z�����>�ຉBF�I��"�	O6�} c	or����z���������.ez�15����~�851662{       <V�$� L� % 4 8 : n o t i f i c a Ho n s 1 6 2 9 9 6�i7 6 4 2 3��T    ���o"conversationId"48:notifications"parentMessageId"1629969976423"messageso":162�310,8:orgid:b085a1cb-b65c-4377-9f96-58f459edd589o"HHtype"Text"content	 t $" "client7 i2� t310"imdisplayname" "
properti�,activityo" T{ replyToR"�imestamp"2021-08-26T09:26:14.229Z"
aT�[IdN  ���SB"sourceThreadId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"sNMe-�(N �;��wB"	h�Chain� Ь?��wB"	UserId"5��2fb40af1-aab8-412f-9411-059a8ee58f7f"ss<mD)R N!RlJuliano, Kent Nolan"target.j�0"count"45"-נPreview"MLTR sir - Sleeping Child sir"m)/$TemplateOpA�"hasEQ 1� CAYDxto"WebhookCorrelq�$404ad1d6-8f03-4630-8593-31209748748c"N|ProcessingLatency"	2081.0749{")} TEPTopic"&ATAS Virtual S=Ton 3(Aug. 26-Sep. 8)"#.; HRosterNonBotMemberC!0I�".( �IsPrivateChannel"false{"s2spartnere<skypespaces{"6E423"e|M)_8"
sequenceIdI�u�Kind"M*Locala�(mposetime"F8T6.4230000Z"originalar� l�3  � A	1a�}�@7T02:47:29.554Z".��Link"Rhttps://amer.ng.msg.teams.microsoft.com/v1/users/ME/c�/s/4>-from"i�Z tacts/�7")�0I"idUnion"����� �ionNuATN pƉR .R A m�(StorageStat�isAcap8ExecuteUpdateF"~Acreated!�}or���C,isFromMeT"!�4HasStarredF"r�ӥa�$stDelivery6z s�".	<LevelI"trimmedM�I n��PisSanitizedT"isRich�!�  	? PՒ#,isForceDele!A,isSfBGroupC]$F"callDur�� "tParticipantsMrisA $  "cachedOme.4v� b9 Utc9�_|,Recording0"$Transcript@meetingObjects0"4.� ��"	_pinS!� o!�lPinnedF{{-{"isInsideChat"��"lat:�"000yd423{5�7 0 0 1 2 6 8 5�	 ��	$70012685"m so"	369,�� o�^���	�	�	51.443�	�	 Q��	�3b868ffa-929e-4616-a47b-087905875e78"b	TMachado, Timothy John�	Z	 c=��"��>��0dcea1d9-be12-41a4-942d-cc3c25bc0c9f"a�
Pr>�$925.8657{������e.a�j� ����52.685��.3 ��������r�%�369��Р�;:�RA���O6�} c	or����z���������.ez�15����r�Qk${       ���%� L� % 4 8 : n o t i f i c a �uo n s 1 6 2 9 9 7 0 0 7 6 5 7 8��T    ���o"conversationId"48:notifications"parentMessageId"1629970076578"meso":1�i21,8:orgid:b085a1cb-b65c-4377-9f96-58f459edd589o"messagetype"Text"contenttype"text"content" "clientm	7 i6� p21"imdisplayname" "
properti�,activityo" Th replyToR"�imestamp"2021-08-26T09:27:55.294Z"
aT�[IdN  ���SB"sourceThreadId"<19:87H6pqWkLmhPSuHYrWFYK6NzAiK-5hVj1I0ljrOur2E1@thread.tacv2"sN M	�h ���wB"	h�Chain Ь?��wB"	UserId"5��6219bbc7-827c-44cc-aeec-15b65a25c738"sttribute("title"))},commit:function(a,b){1==a?(this.getValue()||this.isChanged())&&b.setAttribute("title",this.getValue()):4==a?b.setAttribute("title",this.getValue()):8==a&&b.removeAttribute("title")}}]},{type:"text",id:"txtdlgGenStyle",
requiredContent:"img{cke-xyz}",label:d.lang.common.cssStyle,validate:CKEDITOR.dialog.validate.inlineStyle(d.lang.common.invalidInlineStyle),"default":"",setup:function(a,b){if(1==a){var c=b.getAttribute("style");!c&&b.$.style.cssText&&(c=b.$.style.cssText);this.setValue(c);var d=b.$.style.height,c=b.$.style.width,d=(d?d:"").match(l),c=(c?c:"").match(l);this.attributesInStyle={height:!!d,width:!!c}}},onChange:function(){g.call(this,"info:cmbFloat info:cmbAlign info:txtVSpace info:txtHSpace info:txtBorder info:txtWidth info:txtHeight".split(" "));
e(this)},commit:function(a,b){1==a&&(this.getValue()||this.isChanged())&&b.setAttribute("style",this.getValue())}}]}]}};CKEDITOR.dialog.add("image",function(d){return u(d,"image")});CKEDITOR.dialog.add("imagebutton",function(d){return u(d,"imagebutton")})})();