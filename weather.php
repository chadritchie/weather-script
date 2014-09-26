<head>
<style type="text/css">
/* CSS goes here */
#wxWrap {
	width: 300px;
	padding: 2px 13px 2px 11px;
	height: 33px;
}
#wxIntro {
	display: inline-block;
	font: 14px/20px Lucida Grande, Lucida Sans, Arial, sans-serif;
	color: #1D1B56;
	vertical-align: top;
	padding-top: 9px;
}
#wxIcon {
    display: inline-block;
    width: 61px;
    height: 34px;
    margin: 2px 0 -1px 1px;
    overflow: hidden;
    background: url('http://l.yimg.com/a/lib/ywc/img/wicons.png') no-repeat 61px 0;
}
#wxIcon2 {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin: 1px 6px 0 8px;
    overflow: hidden;
}
#wxTemp {
    display: inline-block;
    font: 20px/28px Arial,Verdana,sans-serif;
    color: #1D1B56;
    vertical-align: top;
    padding-top: 5px;
    margin-left: 0;
}
</style>

</head>

<body>

<div id="wxWrap">
    <span id="wxIntro">
        Currently in Taylorsville, NC: 
    </span>
    <span id="wxIcon2"></span>
    <span id="wxTemp"></span>
</div>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
// javascript will go here
$(function(){

    // Specify the ZIP/location code and units (f or c)
    var loc = '28681'; // or e.g. SPXX0050
    var u = 'f';

    var query = "SELECT item.condition FROM weather.forecast WHERE location='" + loc + "' AND u='" + u + "'";
    var cacheBuster = Math.floor((new Date().getTime()) / 1200 / 1000);
    var url = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(query) + '&format=json&_nocache=' + cacheBuster;

    window['wxCallback'] = function(data) {
        var info = data.query.results.channel.item.condition;
        $('#wxIcon').css({
            backgroundPosition: '-' + (61 * info.code) + 'px 0'
        }).attr({
            title: info.text
        });
        $('#wxIcon2').append('<img src="http://l.yimg.com/a/i/us/we/52/' + info.code + '.gif" width="34" height="34" title="' + info.text + '" />');
        $('#wxTemp').html(info.temp + '&deg;' + (u.toUpperCase()));
    };

    $.ajax({
        url: url,
        dataType: 'jsonp',
        cache: true,
        jsonpCallback: 'wxCallback'
    });
    
});
</script>