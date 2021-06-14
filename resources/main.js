jQuery(document).ready(function () {

    jQuery('.tab').on('click', function (e) {
        jQuery('.tab').removeClass('active-tab');
        jQuery(this).addClass('active-tab');
        let data_tab = jQuery(this).attr('data-tab');
        jQuery('.tab-c').removeClass('show');
        console.log(data_tab);
        jQuery('.' + data_tab).addClass('show');
    })
})