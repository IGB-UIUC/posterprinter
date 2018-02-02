function cfopAdvance1() {
	var length = document.forms["posterInfo"].cfop1.value.length;
	if (length == 1) {
		document.forms["posterInfo"].cfop2.focus()
	}	
}

function cfopAdvance2() {
	var length = document.forms["posterInfo"].cfop2.value.length;
	if (length >= 6) {
		document.forms["posterInfo"].cfop3.focus()
	}
	
}
function cfopAdvance3() {
	var length = document.forms["posterInfo"].cfop3.value.length;
	if (length >= 6) {
		document.forms["posterInfo"].cfop4.focus()
	}
	
}

function uploadFile() {
	var fd = new FormData();
	fd.append("posterFile", document.getElementById('posterFile').files[0]);
	fd.append('posterWidth',document.getElementById('posterWidth').value);
	fd.append('posterLength',document.getElementById('posterLength').value);
	fd.append('paperTypesId',document.querySelector('input[name="paperTypesId"]:checked').value);
	fd.append('finishOptionsId',document.querySelector('input[name="finishOptionsId"]:checked').value);
	fd.append('cfop1',document.getElementById('cfop1').value);
	fd.append('cfop2',document.getElementById('cfop2').value);
	fd.append('cfop3',document.getElementById('cfop3').value);
	fd.append('cfop4',document.getElementById('cfop4').value);
	fd.append('activityCode',document.getElementById('activityCode').value);
	fd.append('email',document.getElementById('email').value);
	fd.append('additional_emails',document.getElementById('additional_emails').value);
	fd.append('name',document.getElementById('name').value);
	fd.append('comments',document.getElementById('comments').value);
	fd.append('posterTube',document.getElementById('posterTube').checked);
	fd.append('rushOrder',document.getElementById('rushOrder').checked);

        var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", uploadProgress, false);
	xhr.addEventListener("load", uploadComplete, false);
	xhr.addEventListener("error", uploadFailed, false);
	xhr.addEventListener("abort", uploadCanceled, false);
	disableForm();
        xhr.open("POST", "create.php",true);
        xhr.send(fd);
	xhr.onreadystatechange  = function(){
		if (xhr.readyState == 4  ) {

			// Javascript function JSON.parse to parse JSON data
			var jsonObj = JSON.parse(xhr.responseText);

			// jsonObj variable now contains the data structure and can
			// be accessed as jsonObj.name and jsonObj.country.
			if (jsonObj.valid) {
				var parameters = jsonObj.post;
				var form = $('<form></form>');
                                //form.attr('method','post');
                                //form.attr('action','index.php');
                                //$.each(parameters,function(key,value) {
                                //        var field = $('<input></input>');

                                //        field.attr("type", "hidden");
                                //        field.attr("name", key);
                                //        field.attr("value", value);
                                //        form.append(field);
                                //}
                                $document.body.append(form);
                                form.submit();


			}
			if (jsonObj.message) {
				enableForm();
				document.getElementById("message").innerHTML =  jsonObj.message;
			}
			
		}
	}

}

function uploadProgress(evt) {
        if (evt.lengthComputable) {
		var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		document.getElementById('progress_bar').innerHTML = "Uploading File: " + percentComplete.toString() + "%";
		document.getElementById('progress_bar').style= "width: " + percentComplete.toString() + "%;";
		document.getElementById('progress_bar').getAttribute("aria-valuenow").vlaue = percentComplete.toString();
        }
        else {
          document.getElementById('progres_bar').innerHTML = 'Error';
        }
      }

function uploadComplete(evt) {
        /* This event is raised when the server send back a response */
        //alert(evt.target.responseText);
      }

function uploadFailed(evt) {
        alert("There was an error attempting to upload the file.");
      }

function uploadCanceled(evt) {
        alert("The upload has been canceled by the user or the browser dropped the connection.");
      }

function disableForm() {
                document.getElementById('poster_field').disabled = true;
}
function enableForm() {
                document.getElementById('poster_field').disabled = false;

}


