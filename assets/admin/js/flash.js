// Código para retirar o clique a mais no IE
var cappen = function(arquivo,largura,altura,vars){
document.write("<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+largura+"' height='"+altura+"' id='index' align='middle'>");
document.write("<param name='allowScriptAccess' value='sameDomain' />");
document.write("<param name='movie' value='"+arquivo+"' />");
document.write("<param name='quality' value='high' />");
document.write("<param name='bgcolor' value='#FFFFFF' />");
document.write("<param name='scale' value='noscale' />");
document.write("<param name='FlashVars' value='"+vars+"' />");
document.write("<param name='wmode' value='transparent' />");
document.write("<embed src='"+arquivo+"' FlashVars='"+vars+"' wmode='transparent' quality='high' bgcolor='#FFFFFF' width='"+largura+"' height='"+altura+"' name='index' align='top' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />");
document.write("</object>");
};