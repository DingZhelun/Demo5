
function CheckEmail(){
    if (email.value==""){
        $('#email').next().html("E-mail can not be empty!");
        $(this).prev().css("color","#f00");
    }else {
        $(this).prev().css("color","#0EA74A");
        $('#email').next().html("");
    }
}

function InputCheck(){
    if (email.value==""){
        alert("Please input email!")
        Login.email.focus();
        return(false);
    }
    if (password.value==""){
        alert("Please input password!")
        Login.password.focus();
        return(false);
    }
}
