/*
 * not need look autoProvideVariables in webpack.config.js
 * const $ = require('jquery');
 */
require('bootstrap-sass');

$.ajaxSetup({
  contentType: "application/json; charset=utf-8"
});

$(document).ready(function () {
  const currentIdPlayer = $('#container-body').data('player-id');

  function checkWhispers()
  {
    var $spanBadge = $('#badge-whisp');

    $.get(apiWhispers, {
      'toPlayer.id': [currentIdPlayer],
      'isread': false
    }, 'json').done(function (whisps) {
      console.log(whisps);
      var nbWhisp = whisps.length;

      $spanBadge.empty();
      if (nbWhisp) {
        $spanBadge.append(nbWhisp);
      }
    }).fail(function (data) {
      console.error("error: ajax apiWhispers: " + data);
    });

    setTimeout(checkWhispers, 10000);
  }

  checkWhispers();
});