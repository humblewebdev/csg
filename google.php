<html>
<script language=JavaScript>
<!-- 
function clear_textbox2()
{
if (document.searc.q.value = "Google Search")
document.searc.q.value = "";
} 
-->
</script>
<form name="searc" action=" http://www.google.com/search" method="get">
<input name=q type="text" onFocus=clear_textbox2() id="url" value="Google Search">
<input type="submit" value="Go"/></form>