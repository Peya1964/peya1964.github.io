function select_day(obj,p1,p2,p3,p4,p5,p6,pc) {


    var sem = 0;
    var sem2 = 0;
    var sel_count = 0;   
    var min_date = '';
    var max_date = '';
    var ap_1_sem = 0;
    var ap_2_sem = 0;
    var ap_3_sem = 0;
    var ap_4_sem = 0; 
    
    if (obj.hasClass("day-selected")){
            obj.removeClass('day-selected');    
    }else{
            obj.addClass('day-selected');
    }    

    jQuery(".bc-day").each(function() {
        if (jQuery(this).hasClass( "day-selected" )){
            if (sel_count == 0){
                min_date = jQuery(this).attr('sbs-date');
            }  
            sem = 1;
            sel_count++;        
            max_date = jQuery(this).attr('sbs-date');       
        }
    });

    if (sel_count>0){
        jQuery('#sbs-start-date-value').html( min_date );
        jQuery('#sbs-arr').val(min_date);
        jQuery('#sbs-end-date-value').html( max_date );
        jQuery('#sbs-dep').val(max_date);

        var msDay = 60*60*24*1000;
        m1 = new Date(min_date);
        m2 = new Date(max_date);

        jQuery('#sbs-diff-date-value').html( Math.floor((m2 - m1 - 1) / msDay)+1 );

    }else{

        jQuery('#sbs-start-date-value').html('');
        jQuery('#sbs-diff-date-value').html('');
        jQuery('#sbs-end-date-value').html('');

    }

    if (sel_count>0) {  
        jQuery('#sbs-booking-form').slideDown( "slow" );        
    }else{
        jQuery('#sbs-booking-form').slideUp( "slow" );  
    };    

    if (sel_count>0) {
        jQuery(".bc-day").each(function() {
            if (jQuery(this).attr('sbs-date')==min_date){
                sem2=1;
            }
            if (sem2==1){
                jQuery(this).addClass('day-selected');
                if ( jQuery(this).children('.bc-aval').children('.mn-box-0').hasClass('b-accepted') ){
                    ap_1_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-1').hasClass('b-accepted') ){
                    ap_2_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-2').hasClass('b-accepted') ){
                    ap_3_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-3').hasClass('b-accepted') ){
                    ap_4_sem = 1;
                }                                                

                if ( jQuery(this).children('.bc-aval').children('.mn-box-0').hasClass('b-pending') ){
                    ap_1_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-1').hasClass('b-pending') ){
                    ap_2_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-2').hasClass('b-pending') ){
                    ap_3_sem = 1;
                }
                if ( jQuery(this).children('.bc-aval').children('.mn-box-3').hasClass('b-pending') ){
                    ap_4_sem = 1;
                }   
            }
            if (jQuery(this).attr('sbs-date')==max_date){
                sem2=0;
            }

        });

        if (ap_1_sem){
            jQuery('#ap-1').addClass('sbs-ap-disables');
        }else{
            jQuery('#ap-1').removeClass('sbs-ap-disables');
        }          

        if (ap_2_sem){
            jQuery('#ap-2').addClass('sbs-ap-disables');
        }else{
            jQuery('#ap-2').removeClass('sbs-ap-disables');
        }          

        if (ap_3_sem){
            jQuery('#ap-3').addClass('sbs-ap-disables');
        }else{
            jQuery('#ap-3').removeClass('sbs-ap-disables');
        }          

        if (ap_4_sem){
            jQuery('#ap-4').addClass('sbs-ap-disables');
        }else{
            jQuery('#ap-4').removeClass('sbs-ap-disables');
        }          

        sbs_calc_price(p1,p2,p3,p4,p5,p6,pc);
    }

}



function select_ap(obj){

    if (!obj.hasClass("sbs-ap-disables")){
        if (obj.hasClass("sbs-ap-selected")){
            obj.removeClass('sbs-ap-selected');    
        }else{
            obj.addClass('sbs-ap-selected');
        }

        if (jQuery('#ap-1').hasClass("sbs-ap-selected")){
            jQuery('#sbs-ap1').val(1);
        }else{
            jQuery('#sbs-ap1').val(0);
        }

        if (jQuery('#ap-2').hasClass("sbs-ap-selected")){
            jQuery('#sbs-ap2').val(1);
        }else{
            jQuery('#sbs-ap2').val(0);
        }

        if (jQuery('#ap-3').hasClass("sbs-ap-selected")){
            jQuery('#sbs-ap3').val(1);
        }else{
            jQuery('#sbs-ap3').val(0);
        }

        if (jQuery('#ap-4').hasClass("sbs-ap-selected")){
            jQuery('#sbs-ap4').val(1);
        }else{
            jQuery('#sbs-ap4').val(0);
        }                

        var req_ap = parseInt(jQuery('.sbs-info-value').html());
        var selected_count = jQuery('.sbs-ap-selected').size();
        if ( req_ap == selected_count ){
            jQuery('#sbs-send-booking').slideDown( "slow" );
        }else{
            jQuery('#sbs-send-booking').slideUp( "slow" );
        }
    }     
}


function sbs_calc_price(p1,p2,p3,p4,p5,p6,pc){

    var cc=0;
    var pc=0;
    var days = jQuery('#sbs-diff-date-value').html();

    var total_person=0;

    var total=0;

    var price_per_person = [ 0,parseInt(p1),parseInt(p2),parseInt(p3),parseInt(p4),parseInt(p5),parseInt(p6) ];
    var aval_ap_count = 4-parseInt( jQuery('.sbs-ap-disables').size() );

    if ( jQuery('#sbs-person-count').val()!='' ){

        if ( jQuery('#sbs-person-count').val()==0 ){

            jQuery('#sbs-price').slideUp( "slow" );    

            jQuery('#sbs-choose-apartman').slideUp( "slow" );

        }else{



            if (jQuery('#sbs-error-wrapper').is(':visible') ){

                jQuery('#sbs-error-wrapper').slideUp( "slow" );

                jQuery('.sbs-error').slideUp( "slow" );

            }

            pc = jQuery('#sbs-person-count').val();

            if ( jQuery('#sbs-child-count').val()!='' ){
                cc = jQuery('#sbs-child-count').val();
            }        

            total_person = parseInt(pc) + parseInt(cc); 

            if (total_person<=6){
                total = ((price_per_person[total_person]*total_person)-(parseInt(pc)*cc)) * days; 
            }else{
                total = ((price_per_person[6]*total_person)-(parseInt(pc)*cc))* days;
            }
           

            if (total_person<=24){        
                if ( (aval_ap_count*6) >= (total_person) ){

                    jQuery('#sbs-price-value').html(total+' Ft');

                    jQuery('#sbs-pri').val(total);

                    

                    jQuery('#sbs-price').slideDown( "slow" );                    

                    jQuery('#sbs-choose-apartman').slideDown( "slow" );

                    

                    var req_ap = Math.ceil(total_person/6);

                    

                    jQuery('.sbs-info-value').html(req_ap);

                    

                }else{

                    

                    jQuery('#sbs-price').slideUp( "slow" );    

                    jQuery('#sbs-choose-apartman').slideUp( "slow" );

                    

                    jQuery('#sbs-error-wrapper').slideDown( "slow" );

                    jQuery('.insuf-space').slideDown( "slow" );                

                }        

            }else{

                    jQuery('#sbs-price').slideUp( "slow" );    

                    jQuery('#sbs-choose-apartman').slideUp( "slow" );

                    

                    jQuery('#sbs-error-wrapper').slideDown( "slow" );

                    jQuery('.out-of-cap').slideDown( "slow" );                

            }

        }            

    }

}



function select_cal_tab(obj){
    var a = '#cal-'+obj.attr('sbs-cal-tab');
    if (!jQuery(a).is(':visible') ){
        jQuery('.sbs-cal-tab-wrapper').slideUp( "slow" );
        jQuery(a).slideDown( "slow" );
        jQuery(a).addClass('sbs-active-cal-tab');
        jQuery('.sbs-cal-header').removeClass('sbs-active-cal-tab');
    } 
}



function check_data(){
    if ( jQuery('#sbs-name').val()!='' ){
        if ( jQuery('#sbs-mail').val()!='' ){
            if ( jQuery('#sbs-tel').val()!='' ){
                jQuery('#sbs-submit').slideDown( "fast" );
            }else{
                jQuery('#sbs-submit').slideUp( "fast" );
            }
        }else{
            jQuery('#sbs-submit').slideUp( "fast" );
        }
    }else{
        jQuery('#sbs-submit').slideUp( "fast" );
    }
}


function sbs_load_cal(date) {
    var target='#target-'+date;
    var tab='#sbs-month-tab-'+date;

    if (jQuery(target).html()==""){
        var tmp = date.split("-");
        var url = '/booking/cal/'+tmp[0]+'/'+tmp[1];
       
        jQuery(target).load(url, function() {
            jQuery('.sbs-cal-body').slideUp( "slow" );
           
            jQuery('.sbs-cal-body').removeClass('active');
            jQuery('.sbs-month-selector').removeClass('active');
           
            jQuery(target).slideDown( "slow" );
            jQuery(tab).addClass('active');
        });
    }else{
        jQuery('.sbs-cal-body').slideUp( "slow" );
        jQuery(target).slideDown( "slow" );
    }
}

function reset_sbs() {
    jQuery(".day-selected").removeClass('day-selected');
    jQuery('.sbs-ap-selected').removeClass('sbs-ap-selected');
    jQuery('#sbs-start-date-value').html('');
    jQuery('#sbs-diff-date-value').html('');
    jQuery('#sbs-end-date-value').html('');
    jQuery('#sbs-booking-form').slideUp( "slow" );

}

function validateForm() {
    if ( jQuery('#sbs-arr').val() == "" ) {
      return false;    
    }else if ( jQuery('#sbs-dep').val() == "" ) {
      return false;    
    }else if ( jQuery('#sbs-pri').val() == "0" ) {
      return false;    
    }else{
      return true;
    }
}