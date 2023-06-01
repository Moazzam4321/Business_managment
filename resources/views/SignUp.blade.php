<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        #signup-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        #sign_up {
            border: 2px solid #000;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
            margin-top: 80px;
            padding: 5px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            width: 120px;
            background-color: #f2f2f2;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .card-body {
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: left;
            background-color: #f2f2f2;
        }
        label {
            margin-left: 5px ;
            padding: 0px;
            font-weight: bold;
            text-align: center;
        }
        input[type=text], input[type=email], input[type=date], input[type=file] {
          padding: 8px;
          border-radius: 4px;
          border: 2px solid black;
          margin: 10px;
          color: black;
          text-align: left;
        }
        button[type=submit] {
            margin-left: 165px;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }
        button[type=submit]:hover {
            background-color: #0069d9;
        }
        #response-message {
            margin-top: 10px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<div id="signup-form-container">
    <div class="card">
        <div class="card-body">
            <div id="sign_up">Sign Up</div>
            <form id="signup-form" method="POST" action="{{ route('sign_up') }}" enctype="multipart/form-data">
                <div id="response-message"></div>
                <div class="form-group">
                    <label for="first_name">{{ __('First_name:') }}</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                </div>

                <div class="form-group">
                    <label for="last_name">{{ __('Last_name:') }}</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                </div>

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address:') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="dob">{{ __('Date of Birth') }}</label>
                    <input id="dob" type="date" class="form-control" name="dob">
                </div>

                <div class="form-group">
                    <label for="profile_picture">{{ __('Profile_Picture') }}</label>
                    <input id="profile_picture" type="file" class="form-control" name="profile_picture">
                </div>
                <div class = "form-group">
                <input type="hidden" name="profile_picture_base64" id="profile-picture-base64">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
                <div id='output'></div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  console.log("ok");
    function getBase64(file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
              var base64 = reader.result;
              console.log(base64);
                // Append the base64-encoded profile picture to the form data
              $('form#signup-form').append('<input type="hidden" name="profile_picture_base64" value="' + base64 + '">');
            };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }

    $('#profile_picture').on('change', function() {
        var file = this.files[0];
        getBase64(file);
    });

    // submit the form using AJAX
    $('#signup-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                // display the response message in an alert box
                alert(response.message);
            },
            error: function(xhr, status, error) {
                // display the error message in the alert box
                var errorMessage = 'Error: ' + xhr.status + ' ' + xhr.statusText + '\n' + xhr.responseText;
                var alertBox = $('<div>').addClass('alert alert-danger').text(errorMessage);
                var closeButton = $('<button>').addClass('btn btn-primary').text('Close');
                alertBox.append(closeButton);
                closeButton.click(function() {
                    alertBox.remove();
                });
                alert(alertBox);
            }
        });
    });
});
</script>
</html>
