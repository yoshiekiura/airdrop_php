$('#counter').countdown('2019/05/06', function(event) {
     $(this).html(event.strftime('<div class="counter-wrapper"><div class="counter-block">%D</div><span class="counter-tag">DAYS</span></div><div class="counter-wrapper"><div class="counter-block">%H</div><span class="counter-tag">HOURS</span></div><div class="counter-wrapper"><div class="counter-block">%M</div><span class="counter-tag">MINUTES</span></div><div class="counter-wrapper"><div class="counter-block">%S</div><span class="counter-tag">SECONDS</span></div>'));

/*
 * Replced old code for Language support
 * Added Id's for each replacable element
 * Mapping done on each id by countdown event.
 */

    $(this).find("#counter_d").html(event.strftime('%D'));
    $(this).find("#counter_h").html(event.strftime('%H'));
    $(this).find("#counter_m").html(event.strftime('%M'));
    $(this).find("#counter_s").html(event.strftime('%S'));

  });