$(document).ready(function() {  
  $('#node-form .group-sites-field-verify-source input').each(function() {
    var state = $(this).is(':checked');
    if (state == true) {
      //jQuesry 1.2.xm so we (unfortunaltely) can't use .closest().
      $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-return-url').show();
      $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-invalid-referrer-text').show();
      $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-override-param').show();
      $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-shared-salt').show();
    }
  });
  $('#node-form .group-sites-field-verify-source input').click(function() {
    $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-return-url').toggle();
    $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-invalid-referrer-text').toggle();
    $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-override-param').toggle();
    $(this).parent('label').parent('.form-item').parent('.group-sites-field-verify-source').siblings('.group-sites-field-shared-salt').toggle();
  });
});