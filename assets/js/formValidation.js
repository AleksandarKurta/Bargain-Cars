
function emailValidation(){
    var field = document.getElementById("email");
    return validate(field);
}

function firstnameValidation(){
    var field = document.getElementById("first_name");
    return validate(field);
}

function lastnameValidation(){
    var field = document.getElementById("last_name");
    return validate(field);
}

function usernameValidation(){
    var field = document.getElementById("user_name");
    return validate(field);
}

function password1Validation(){
    var field1 = document.getElementById("password1");
    var field2 = document.getElementById("password2");
        validate(field1);
        if(field1.value == field2.value){
            document.getElementById("p_" + field1.name).innerHTML = "<span style='color:green'> OK </span>";
            return true;
        }else if(validate(field1)){
            document.getElementById("p_" + field1.name).innerHTML = "<span style='color:blue'>  Passwords must match </span>";
            return false;
        }
}

function password2Validation(){
    var field1 = document.getElementById("password1");
    var field2 = document.getElementById("password2");
        validate(field2);
        if(field1.value == field2.value){
            document.getElementById("p_" + field1.name).innerHTML = "<span style='color:green'> OK </span>";
            return true;
        }else if(validate(field2)){
            document.getElementById("p_" + field2.name).innerHTML = "<span style='color:blue'> Passwords must match </span>";
            return false;
        }
}

function validate(field){
    var fieldValue = field.value;
    var fieldName = field.name;
    switch(fieldName){
        case "email":
            var RegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var msg = "Invalid email address";
        break;
        case "first_name":
        case "last_name":
        case "user_name":
            var RegExp = /^[a-zA-z]+$/;
            var msg = "Field must contain letters only";
        break;
        case "password1":
            var RegExp = /^.{7,}$/;
            var msg = "Password must have more than seven characters.";
        break;
        case "password2":
            var RegExp = /^.{7,}$/;
            var msg = "Password must have more than seven characters.";
        break;
    }
    
    if(!(RegExp.test(fieldValue))){
        document.getElementById("p_" + fieldName).innerHTML = "<span style='color:red'>" + msg + "</span>";
        return false;
    }else{
        document.getElementById("p_" + fieldName).innerHTML = "<span style='color:green'> OK </span>";
        return true;
    }
}

function submitForm(){
    if(emailValidation() && firstnameValidation() && lastnameValidation() && usernameValidation() && password1Validation() && password2Validation()){
        return true;
    }else{
        return false;      
    }
}
