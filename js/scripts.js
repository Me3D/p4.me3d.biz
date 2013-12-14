
$(document).ready(function() {
	var interval = 2000;
	var t;
	
	/*update the target table*/
	var refresh_targets = function() {
		$.when($.ajax({
			url: '/target/update',
			dataType: 'json',
			async: true,
			success: function( targets ){
				t = targets;
				setTimeout(function() {
					refresh_targets();
				}, interval);
			}//end success
		})).then(
			function (){
				var new_table ="" ;
				for (i = 0; i < t.length; i++) {
					new_table += '<tr id="' + i + '"><td class="tid">' + t[i].target_id + '</td><td class="ip"> ' + t[i].target_ip + '</td><td class="os">' + t[i].os + '</td><td class="scan">' + t[i].scanned + '</td><td class="description">' + t[i].description + '</td></tr>';
				};
				$('#example > tbody').html(new_table);
			});
		;//end ajax
	};//end refresh
	refresh_targets(); //restart it all

	/*update the chat text area*/
	var refresh_chat = function() {
		var oldscrollHeight = $("#chat")[0].scrollHeight; /* this line inspired from http://stackoverflow.com/questions/12657206/how-to-scroll-down-to-new-messages-on-ajax-chat */
		//go get the last 50 chat messages
		$.when($.ajax({
			url: '/chat/get',
			dataType: 'json',
			async: true,
			success: function( chats ){
				c = chats;
				setTimeout(function() {
					refresh_chat();
				}, interval);
			}//end success
		})).then(
			function (){ //stuff chats into the chat div
				var new_chat = "";
				for (i = 0; i < c.length; i++) {
					new_chat += '<div class="chat_username">' + c[i].username + ': </div><div class="chat_message">' + c[i].message + '</div>' + '<p></p>';
				};
				$('#chat').html(new_chat);
				
				//control scrolling. Stay put unless a new message pops in.
				/*these three lines inspired from http://stackoverflow.com/questions/12657206/how-to-scroll-down-to-new-messages-on-ajax-chat */
				var newscrollHeight = $("#chat")[0].scrollHeight;
				if(newscrollHeight > oldscrollHeight){
					$("#chat").scrollTop($("#chat")[0].scrollHeight);
				}
			});
		;//end ajax
	};//end refresh
	refresh_chat(); //restart it all
	
			
	
	
	/*modal dialog when clicking on forms*/
	$(document).on("click", ".tableContainer table tr", function(e) {
		var tid = $(this).find('.tid').html();
		console.log(tid);
		var url = "/target/target/" + tid;
		
		$.when($.ajax({
			url: url,
			dataType: 'json',
			async: true,
			success: function( target ){
				t = target;
				console.log(t);
			}//end success
		})).then(
			function (){
				//var target_table ="" ;
	
				//target_table = '<table><tbody><tr id="' + tid + '"><td class="tid">' + t[0].target_id + '</td><td class="ip"> ' + t[0].target_ip + '</td><td class="os">' + t[0].os + '</td><td class="scan">' + t[0].scanned + '</td><td class="description">' + t[0].description + '</td></tr></tbody></table>';
				
				//Set modal dialog title
				$('#modal_title').html("Target ID " + t[0].target_id);
				//set IP address, OS, Scanned and Notes
				$('#tid').val(t[0].target_id);
				$('#ip_address').val(t[0].target_ip);
				$('#os').val(t[0].os);
				$('#scanned').val(t[0].scanned);
				$('#notes').val(htmlspecialchars_decode(t[0].notes),'ENT_NOQUOTES'); //this converts the funky htmlspecial chars to text.
				$('#description').val(htmlspecialchars_decode(t[0].description),'ENT_NOQUOTES'); //this converts the funky htmlspecial chars to text.
				
				//var target_form = "";
				
				$('#modal').modal();
				//$('#in_modal').html(target_table);
	
				//console.log(target_table);
			}); //end then function()
		       ;//end ajax	
		}); //end doc table onclick
	
	
	//Add Target Button in NAVBAR
	$("#add_target").click(function(){
		
		$('#change_action').attr("action", "/target/add_target"); //change the submit buttons target url
		$("button").remove("#del_but");					//get rid of delete button
		$('#modal_title').html("New Target");
		$('#tid').val("");
		$('#ip_address').val("");
		$('#os').val("");
		$('#scanned').val("");
		$('#notes').val(""); //this converts the funky htmlspecial chars to text.
		$('#description').val(""); //this converts the funky htmlspecial chars to text.
		$('#modal').modal();	//fire model dialog		
	}); //end add_target
	

	$('#send-message-button').click(function(){		
		var message = $('#message').val();		
		$.ajax({
			type: "POST",
			url: "/chat/send",
			data: { message : message }, //all the user object POST vars get dragged along too
			success: function(){
				$('#message').val("");	//clear the text input box
			}
		})//end ajax			
	return false;	
	});	//end click
	
	
	
}); //Document ready




/*htmlspecialchars  sourced from http://phpjs.org/functions/htmlspecialchars_decode/*/
function htmlspecialchars_decode (string, quote_style) {
  // http://kevin.vanzonneveld.net
  // +   original by: Mirek Slugen
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Mateusz "loonquawl" Zalega
  // +      input by: ReverseSyntax
  // +      input by: Slawomir Kaniecki
  // +      input by: Scott Cariss
  // +      input by: Francois
  // +   bugfixed by: Onno Marsman
  // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // +      input by: Ratheous
  // +      input by: Mailfaker (http://www.weedem.fr/)
  // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +    bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
  // *     returns 1: '<p>this -> &quot;</p>'
  // *     example 2: htmlspecialchars_decode("&amp;quot;");
  // *     returns 2: '&quot;'
  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined') {
    quote_style = 2;
  }
  string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
    // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"');
  }
  // Put this in last place to avoid escape being double-decoded
  string = string.replace(/&amp;/g, '&');

  return string;
}
