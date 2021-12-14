"use strict";
var $ = jQuery;
var $drdtAddons = {
    
    init: function(){
        // tab menu
        $drdtAddons.tabEvent( '.tab-menu-link');
        $drdtAddons.contantTab();

        // filter widgets data
        $drdtAddons.filterWidgets('.filter_menu > .fiter-data');

        // enable Disabled
        $drdtAddons.enableWidgets('#checkAll');
        $drdtAddons.disableWidgets('#disableAll');

        // pro message 
        $drdtAddons.proPopUpModal('.pro_popup', '.pro_ajax_message');
        $drdtAddons.proPopUpModalClose('.pro-close', '.pro_ajax_message');


        // accrodion
        $drdtAddons.accrodionToggle('.dl_api .dl_api_item');

        // save dashboard
        $drdtAddons.saveForm( 'form#droit-save-widget');

        // generate icon
        let $icon = document.querySelector('.re-generate-icons');
        if($icon){
            $icon.removeEventListener('click', $drdtAddons.regenerate_icons);
            $icon.addEventListener('click', $drdtAddons.regenerate_icons);
        }
        
        // generate css
        let $css = document.querySelector('.re-generate-css');
        if($css){
            $css.removeEventListener('click', $drdtAddons.regenerate_css);
            $css.addEventListener('click', $drdtAddons.regenerate_css);
        }

    },

    tabEvent: function( $selector ){
        document.querySelectorAll($selector).forEach(function($v){
            $v.removeEventListener('click', $drdtAddons.openTab);
            $v.addEventListener('click', $drdtAddons.openTab);
        });
    },

    activeAction: function( $selector ){
        document.querySelectorAll($selector).forEach(function($v){
            $v.classList.remove("active");
        });
    },
    
    openTab: function(e){
        let $this = (this);
        let $target = $this.getAttribute('data-content');
        if( !$target ){
            return;
        }
         // active link
         let ur = window.location.href;
         let urlspl = ur.split('#');
         if( urlspl[1] ){
             ur = urlspl[0];
         }
 
         setTimeout(function(){
             window.location.href = ur+'#'+$target;
             $drdtAddons.contantTab();
         }, 5);
    },

    contantTab: function(){

        $(window).scrollTop(0);

        let ur = window.location.href;
        let urlspl = ur.split('#');

        if( urlspl ){ 
            let tab = urlspl[1];
            let $this = document.querySelector('a[data-content="'+tab+'"]');
            if( !$this ){
                $this = document.querySelector('a[data-content]');
            }

            if( !$this ){
                return;
            }
            let $target = $this.getAttribute('data-content');
            
            $drdtAddons.activeAction('.tab-menu-link');
            $drdtAddons.activeAction('.tab-bar-content');
             
            // add active class
            $this.classList.add("active");
            document.querySelector("#" + $target).classList.add("active");
        }
    },

    filterWidgets: function( $selector ){
        document.querySelectorAll($selector).forEach(function($v){
            $v.removeEventListener('click', $drdtAddons.actionFilter);
            $v.addEventListener('click', $drdtAddons.actionFilter);
        });
    },

    actionFilter: function( e ){
        e.preventDefault();
        let $this = this;
        let $select = $this.getAttribute('data-filter');
        if( !$select ){
            return;
        }
        $drdtAddons.activeAction('#droit_elements .content_wrapper_flex > *');
        $drdtAddons.activeAction('.filter_menu > .fiter-data');
        $this.classList.add('active');

        $("#droit_elements .content_wrapper_flex").isotope({ filter: $select });

    },

    enableWidgets: function( $select ){
       document.querySelector($select).addEventListener('click', function(e){
            e.preventDefault();
            let $this = this;
            document.querySelectorAll('.content_wrapper_flex input[type=checkbox][data-type]').forEach(function($v){
                if( !$v.hasAttribute('disabled') ){
                    //$v.classList.remove('disable_radio');
                    $v.checked = true;
                } else {
                   // $v.classList.add('disable_radio');
                    $v.checked = false;
                }
            });
       });
    },

    disableWidgets: function( $select ){
        document.querySelector($select).addEventListener('click', function(e){
            e.preventDefault();
            let $this = this;
            document.querySelectorAll('.content_wrapper_flex input[type=checkbox][data-type]').forEach(function($v){
               // $v.classList.add('disable_radio');
                $v.checked = false;
            });
       });
    },

    proPopUpModal: function( $selector, $target = '.pro_ajax_message'){
        document.querySelectorAll( $selector ).forEach(function($v){
            $v.addEventListener('click', function(e){
                e.preventDefault();
                document.querySelector($target).classList.add('popup-visible');
            });
        });

    },
    proPopUpModalClose: function( $selector, $target = '.pro_ajax_message'){
        document.querySelectorAll( $selector ).forEach(function($v){
            $v.addEventListener('click', function(e){
                e.preventDefault();
                document.querySelector($target).classList.remove('popup-visible');
            });
        });
    },

    accrodionToggle: function( $selector){

        document.querySelectorAll( $selector ).forEach(function($v){
            if( $v.querySelector('.dl_api_item_title') ){
                var $content = $v.querySelector('.dl_api_panel');
                $v.querySelector('.dl_api_item_title').addEventListener('click', function(e){
                    e.preventDefault();
                    var $this = this;
                    if( $content.style.display == 'block'){
                        $content.style.display = 'none';
                    } else {
                        $content.style.display = 'block';
                    }
                    
                });
            }
            
        });
    },

    saveForm: function( $selector = ''){
       // alert($selector);
       $($selector).on('submit', function(ev){
            // form event close when submit this form
            ev.preventDefault();

            let $this = $(this);

            // get button icon class
            let $btn = $this.find('button.of_save_widget');
            let $btnicon = $this.find('button.of_save_widget > i');
        
            // load the ajax submit when click the submit button
            $.ajax({
                url: dtdr.ajax_url+'?action=dtaddsave_settings',
                type: "post",
                data: {
                    form_data: $this.serialize(),
                    message: 'save settings data'
                },
                // before ajax action
                beforeSend: function() {
                    $btn.html('<i class="fa fa-spinner fa-spin"></i> Saving');
                    $this.addClass('drdt-loading');
                },
                // success ajax 
                success: function(res){
                    // consoole.log(res);
                    var tim = setInterval(function(){
                            $btn.html('<i></i> Save Settings');
                            clearInterval(tim);
                    }, 1500);
                    $btnicon.removeAttr('class');
                },
                // error ajax page
                error: function(res){
                    alert('Something is wrong!!');
                },
                // ajax complate function 
                complete: function() {
                    $btn.html('<i></i> Saved');
                    $btnicon.removeAttr('class');
                    $this.removeClass('drdt-loading');
                },
            });
        });
    },

    regenerate_icons: function(e){
        e.preventDefault();
        let $this = $(this);
        
         // get button icon class
         let $btn = $(this);
         let $btnicon = $btn.find('i');
     
         // load the ajax submit when click the submit button
         $.ajax({
             url: dtdr.ajax_url+'?action=dtaddsave_generateicons',
             type: "post",
             data: {
                 message: 'save generate icons'
             },
             // before ajax action
             beforeSend: function() {
                 $btn.html('<i class="fa fa-spinner fa-spin"></i> Regenerating..');
                 $this.addClass('drdt-loading');
             },
             // success ajax 
             success: function(res){
                 // consoole.log(res);
                 var tim = setInterval(function(){
                         $btn.html('<i></i> Regenerate Icons');
                         clearInterval(tim);
                 }, 1500);
                 $btnicon.removeAttr('class');
             },
             // error ajax page
             error: function(res){
                 alert('Something is wrong!!');
             },
             // ajax complate function 
             complete: function() {
                 $btn.html('<i></i> Regenerated');
                 $btnicon.removeAttr('class');
                 $this.removeClass('drdt-loading');
             },
         });
    },

    regenerate_css: function(e){
        e.preventDefault();
        let $this = $(this);
        
         // get button icon class
         let $btn = $(this);
         let $btnicon = $btn.find('i');
     
         // load the ajax submit when click the submit button
         $.ajax({
             url: dtdr.ajax_url+'?action=dtaddsave_generatecss',
             type: "post",
             data: {
                 message: 'save generate css'
             },
             // before ajax action
             beforeSend: function() {
                 $btn.html('<i class="fa fa-spinner fa-spin"></i> Regenerating..');
                 $this.addClass('drdt-loading');
             },
             // success ajax 
             success: function(res){
                 // consoole.log(res);
                 var tim = setInterval(function(){
                         $btn.html('<i></i> Regenerate All');
                         clearInterval(tim);
                 }, 1500);
                 $btnicon.removeAttr('class');
             },
             // error ajax page
             error: function(res){
                 alert('Something is wrong!!');
             },
             // ajax complate function 
             complete: function() {
                 $btn.html('<i></i> Regenerated');
                 $btnicon.removeAttr('class');
                 $this.removeClass('drdt-loading');
             },
         });
    }

};

$drdtAddons.init();