// JavaScript Document

  $(document).ready(function(){
    var kpcount = $(".keyprojects").length;
	if(kpcount > 3){
		$(".keyprojects").each(function(index, element) {
            if(index>2){
				$(element).hide();
			}
        });
	}
	else{
		$("#kp_btnarea").hide();
	}
	$("#kp_btnviewmore").click(function(){
	 	$(".keyprojects").each(function(index, element) {
            if(index>2){
				$(element).slideDown("slow");
			}
        });
		$(this).hide();
  	});
	
	$("#frmsubmit").on('click',function(){
		if($("#firstname").val() == ""){
			alert("Please fill your first name");
			alert($("#discipline").val());
			return false;
		}else if($("#lastname").val() == ""){
			alert("Please fill your Last Name");
			return false;
		}else if($("#emailid").val() == ""){
			alert("Please fill your Email ID");
			return false;
		}else if(isValidEmailAddress($("#emailid").val()) == 0){
			alert("Invalid Email ID");
			return false;
		}else if($("#selectdisc").val() == 0){
			alert("Please select the discipline you are interested in?");
			return false;
		}else{
			var dataString = $("#gmcform").serialize();
			dataString = dataString + "&req=MAILSEND";
			ajaxCall(dataString,"dataret","container");
			return false;
		}
	});
  });
  
  function ajaxCall(dataString,rettype,loc){
		var url = "./sendmail.php";
		$.ajax({
			type: "POST",
			url: url,
			data:dataString,
			success: function (data) {
      			//alert(data);
				returnedData = JSON.parse(data);
				//alert(returnedData);
				if(returnedData.ret === "SUCCESS"){
					//alert("Success");
					$("#gmcform_container").html('<h2 style="text-align:center">Thanks for showing interest to visit GMC India. <br>You have signed up for a visit. You will hear back from us!</h2>');
				}
				
			},
			error:function (xhr, resp, text)
			{	
				console.log(xhr+' , '+resp+' , '+text);
			},
    		complete: function(){
			
			}
      		
			});
	}
  
  function getProjectDetails(projectid){
	 // alert(data[projectid]['project_name']);
	  $("#project_owner_Section_2").hide();
	  $("#project_name").html(data[projectid]['project_name']);
	  $("#project_discipline").html(data[projectid]['project_discipline']);
	  $("#project_overview").html(data[projectid]['project_overview']);
	  $("#project_challenge").html(data[projectid]['project_challenge']);
	  $("#project_solution").html(data[projectid]['project_solution']);
	  $("#project_results").html(data[projectid]['project_results']);
	  //OWNER 1
	  $("#project_owner_1").html(data[projectid]['project_owner_1']);
	  var pp = data[projectid]['project_ownerphoto_1'];
	  if(pp == ""){pp = "default.png";}
	  $("#project_ownerimg1").attr("src","images/project_photos/"+pp);
	  
	   $("#project_ownerimg1").attr("onclick","document.location.href='"+data[projectid]['project_contact_1']+"'");
	   $("#project_ownerimg1").attr("title","Click here to view "+data[projectid]['project_owner_1']+"'s bluepages profile");
	  $("#project_bio_1").html(data[projectid]['project_bio_1']);
	  
	  if(data[projectid]['project_owner_2'] != ""){
		  $("#project_owner_Section_2").show();
		  $("#project_owner_2").html(data[projectid]['project_owner_2']);
		  var pp = data[projectid]['project_ownerphoto_2'];
	  	  if(pp == ""){pp = "default.png";}
		  $("#project_ownerimg2").attr("src","images/project_photos/"+pp);
		  $("#project_ownerimg2").attr("onclick","document.location.href='"+data[projectid]['project_contact_2']+"'");
	   	  $("#project_ownerimg2").attr("title","Click here to view "+data[projectid]['project_owner_2']+"'s bluepages profile");
		  $("#project_bio_2").html(data[projectid]['project_bio_2']);
	  }
	  
	  IBMCore.common.widget.overlay.show('kpoverlay'); 
	  return false;
	  
  }
  
	  function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	}
