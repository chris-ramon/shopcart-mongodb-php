

jQuery(document).ready(function(){
    $('#checkoutForm input').addClass('nostyle');
    
    $('#goCheckOut').click(function(){
        $('#background').css('opacity','0.6');
        $('#background').fadeIn('slow');
        $('#checkout').fadeIn('slow');
        return false;    
    });
    
    $('.cerrar').click(function(){
        $('#background').fadeOut('slow');
        $('#checkout').fadeOut('slow');
        $('#background').css('opacity','1');
        $('#adviceCOForm').fadeOut();
        $('.advice_msg').remove();
        return false;
    
    });
    $('#checkoutForm').submit(function(){
        var chk,name,address,city;
        
        name = $('input[name="name"]');
        address = $('input[name="address"]');
        city = $('input[name="city"]');
        province = $('input[name="province"]');
        country = $('select[name="country"]');        
        shippingMethod = $('input[name="shippingMethod"]');
        paymentMethod = $('input[name="paymentMethod"]');
        zipCode = $('input[name="zipCode"]');
        phone = $('input[name="phone"]');        
                
        var arr = [name,address,city,province,country,shippingMethod,paymentMethod,zipCode,phone];
        var checked = new Array(arr.length);
        for(i=0;i<arr.length;i++){
            chk = check(arr[i]);  
            checked.push(chk);
            if(chk == false){
                $('#adviceCOForm').slideDown();                    
            }            
        }
        for(i=0;i<checked.length;i++){
            if(checked[i]==false)
                return false;
            if(checked[i]==true){
                var aux = true;
                if(i+1==checked.length && aux==true)
                    return true;
            }
        }
                
    });
    
    check = function(field){
        if(field.val()==""){
            $('#txt_'+field.attr('name')).after("<code class='advice_msg righty'>"+field.attr('name')+" is a required field ...</code>");
            return false;
        }
        else
            return true;
    }
    
    $('#menuTop a:eq(2)').hover(function(){
        $('#mgPro').slideDown();
    });
    
    $('#mgPro').mouseleave(function(){
        $(this).slideUp();
    });
    
    $('.deletePro').click(function(){
        var rs = confirm('Are you sure?');
        if(rs==true){
            $('.formdel').submit();
        }        
    });

    
});
