function InputCheck(){
    if (Login.email.value==""){
        alert("Please input email!")
        Login.email.focus();
        return(false);
    }
    if (Login.password.value==""){
        alert("Please input password!")
        Login.password.focus();
        return(false);
    }
}