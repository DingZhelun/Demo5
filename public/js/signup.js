
function selectRole(){
    var mySelect = document.getElementById("role");
    var index = mySelect.selectedIndex;
    var text = mySelect.options[index].text;
    var value = mySelect.options[index].value;

    if (index == 2){
        document.getElementById("building_text").style.display="block";
        document.getElementById("apartment_text").style.display="block";
        document.getElementById("service_select").style.display="block";
    }else if (index == 1){
        document.getElementById("building_text").style.display="block";
        document.getElementById("apartment_text").style.display="none";
        document.getElementById("service_select").style.display="none";
    }else if (index ==0){
        document.getElementById("building_text").style.display="none";
        document.getElementById("apartment_text").style.display="none";
        document.getElementById("service_select").style.display="block";
    }
}

function selectService(){
    var mySelect = document.getElementById("service");
    var index = mySelect.selectedIndex;
    var text = mySelect.options[index].text;
    var value = mySelect.options[index].value;
    if (index==1){
        document.getElementById("service_div").style.display="block";
    }else{
        document.getElementById("service_div").style.display="none";
    }
}

function InputCheck(){
    if (SignUp.name.value=="" || SignUp.email.value=="" || SignUp.phone.value=="" || SignUp.address.value==""){
        alert("Please complete information!")
        return(false);
    }
}

$(function(){
    $('#subdivision').blur(function (){
        var subdivision = $('#subdivision').val();
        var role = $('#role').val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "get",
            url: "getBuilding",
            data:{subdivision:subdivision,role:role},
            dataType: "json",
            success: function(msg){
                if (role=="Subdivision"){
                    if(msg.length==0){
                        alert("This subdivision is not in the database");
                        document.getElementById("subdivision").value="";
                    }
                    if (msg[0].available=="0"){
                        alert("This subdivision has been registered");
                        document.getElementById("subdivision").value="";
                    }
                }else{
                    document.getElementById("building").options.length=0;
                    for (var i=0; i<msg.length; i++){
                        var obj = document.getElementById("building");
                        var value = msg[i].building_number;
                        obj.options.add(new Option(value));
                    }
                }
            },
            error:function(msg){
                console.log(msg);
            }
        })
    })

})

$(function(){
    $('#building').blur(function (){
        var subdivision = $('#subdivision').val();
        var building_number = Number($('#building').val());
        $.ajax({
            type: "get",
            url: "getApartment",
            data: {subdivision:subdivision,building_number:building_number},
            dataType: "json",
            success: function (msg){
                document.getElementById("apartment").options.length=0;
                for (var i=0; i<msg.length;i++){
                    var obj = document.getElementById("apartment");
                    var value = msg[i].apartment_number;
                    obj.options.add(new Option(value));
                }
            },
            error:function (msg){
                console. log(msg);
            }
        })
    })
})

$(function (){
    $('#service').blur(function (){
        var subdivision = $('#subdivision').val();
        var result = $('#service').val();
        if ($('#service').val()=="Service"){
            $.ajax({
                type: "get",
                url: "getService",
                data: {subdivision:subdivision},
                dataType: "json",
                success: function (msg){
                    if (msg[0].electricity=="1"){
                        document.getElementById("electricity").disabled=true;
                        document.getElementById("electricity").checked=true;
                    }else{
                        document. getElementById("electricity").disabled=false;
                        document.getElementById("electricity").checked=false;
                    }
                    if (msg[0].water=="1"){
                        document.getElementById("water").disabled=true;
                        document.getElementById("water").checked=true;
                    }else{
                        document.getElementById("water").disabled=false;
                        document.getElementById("water").checked=false;
                    }
                    if (msg[0].gas=="1"){
                        document.getElementById("gas").disabled=true;
                        document.getElementById("gas").checked=true;
                    }else{
                        document.getElementById("gas").disabled=false;
                        document.getElementById("gas").checked=false;
                    }

                },
                error:function (msg){
                    console.log(msg);
                }
            })
        }
    })
})

$(function (){
    $('#email').blur(function (){
        var email = $('#email').val();
        $.ajax({
            type: "get",
            url: "getEmail",
            data: {email:email},
            dataType: "json",
            success: function (msg){
                if (msg.length!=0 && msg[0].available=="1"){
                    alert("Email has been registed!");
                    document.getElementById("email").value="";
                }
            },
            error:function (msg){
                console.log(msg);
            }
        })
    })
})

$(function (){
    $('#send_code').click(function (){
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var role = $('#role').val();

        $.ajax({
            type: "get",
            url: "sendCode",
            data: {email:email,name:name,password:password,phone:phone,address:address,role:role},
            dataType: "json",
            success: function (msg){
                alert("send email success");
            },
            error:function (msg){
                console.log(msg);
            }
        })
    })
})

$(function (){
    $('#submit').click(function (){
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var role = $('#role').val();
        var subdivision = $('#subdivision').val();
        var building = Number($('#building').val());
        var apartment = Number($('#apartment').val());
        var code = Number($('#verification_code').val());

        var water;
        var gas;
        var electricity;
        var Internet;

        if ($('#service').val()=="Service"){
            water = $('#water').val();
            gas = $('#gas').val();
            electricity = $('#electricity').val();
            Internet = $('#Internet').val();
        }else{
            water = 0;
            gas = 0;
            electricity =0;
            Internet = 0;
        }
        $.ajax({
            type: "get",
            url: "register",
            data: {name:name,email:email,phone:phone,address:address,role:role,subdivision: subdivision,building:building,apartment:apartment,water:water,gas:gas,electricity:electricity,Internet:Internet,password:password,code:code},
            dataType: "json",
            success: function (msg){
                switch (msg){
                    case 0:
                        alert("Validation code is invalid");
                        break;
                    case 1:
                        alert("Register successfully,Subdivision");
                        window.location.href="login";
                        break;
                    case 2:
                        alert("Register successfully,Building");
                        window.location.href="login";
                        break;
                    case 3:
                        alert("Register successfully,Apartment");
                        window.location.href="login";
                        break;
                }
            },
            error:function (msg){
                console.log(msg);
            }

        })


    })
})

