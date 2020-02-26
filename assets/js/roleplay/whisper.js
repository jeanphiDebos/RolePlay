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
  var checkWhisp        = null;

  function insertWhisper(whisp) {
    var $whisp = $('#whisp-prototype').clone();
    $whisp.attr('id', whisp.id)
      .attr('data-id', whisp.id)
      .attr('data-isread', whisp.isread)
      .removeClass('prototype hide');

    $whisp.find('span').append((new Date(whisp.dateTime)).toLocaleString());
    $whisp.find('h4').append(whisp.whisp);

    if (whisp.isread){
      $whisp.removeClass('is-not-read');
    }

    if (whisp.forPlayer.indexOf(currentIdPlayer) !== -1) {
      $whisp.removeClass('text-left');
    } else {
      $whisp.removeClass('text-right');
    }

    return $whisp;
  }

  function whisperIsread(whisp)
  {
    if (!whisp.isread && whisp.forPlayer.indexOf(currentIdPlayer) === -1){
      $.ajax({
        url: apiWhispers + '/' + whisp.id,
        type: 'PUT',
        data: "{\"isread\": true}"
      }).done(function (whisp) {
        $('#' + whisp.id).delay(100000).removeClass('is-not-read');
      }).fail(function (data) {
        console.error("error: ajax put apiWhispers: " + data);
      });
    } else if (!whisp.isread && whisp.forPlayer.indexOf(currentIdPlayer) !== -1) {
      $('#' + whisp.id).removeClass('is-not-read');
    }
  }

  function scrollToWhisper()
  {
    $('#whisp-tab-content').animate({scrollTop: $('.tab-pane.fade.active').height()}, 500);
  }

  function initWhispersPlayer(idPlayer)
  {
    var $whispTab = $('#' + idPlayer);
    var $spanBadge = $('#' + idPlayer + '-tab').find('span.badge');
    var data = {
      'forPlayer.id': [currentIdPlayer, idPlayer],
      'toPlayer.id': [idPlayer, currentIdPlayer]
    };

    if ($whispTab.data('data') == false) {
      data = {
        'forPlayer.id': [idPlayer],
        'toPlayer.id': [currentIdPlayer],
        'isread': false
      };
    }

    $.get(apiWhispers, data, 'json').done(function (whisps) {
      $.each(whisps, function (index, whisp) {
        $whispTab.append(insertWhisper(whisp));
        whisperIsread(whisp);
      });
      $whispTab.data('data', false);
      $spanBadge.empty();
      scrollToWhisper();
    }).fail(function (data) {
      console.error("error: ajax apiWhispers: " + data);
    });
  }

  function insertWhisp(whisp, currentIdPlayerWhisp){
    if (whisp && currentIdPlayerWhisp) {
      $.post(
        apiWhispers,
        "{\"whisp\": \"" + whisp + "\", \"forPlayer\": \"/api/players/" + currentIdPlayer + "\", \"toPlayer\": \"/api/players/" + currentIdPlayerWhisp + "\"}",
        'json'
      ).done(function (whisp) {
        whisp.isread = true;
        $('#' + currentIdPlayerWhisp).append(insertWhisper(whisp));
        $('#text-send-whisp').val('');
        scrollToWhisper();
      }).fail(function (data) {
        console.error("error: ajax post apiWhispers: " + data);
      });
    }
  }

  function checkHavWhisp()
  {
    var idPlayer = $('.nav-item.active .nav-link').data('id');
    if (idPlayer) {
      initWhispersPlayer(idPlayer);
    }
    checkWhisp = setTimeout(checkHavWhisp, 2000);
  }

  function checkWhispers()
  {
    $('.nav.nav-tabs .nav-link').each(function(index) {
      var idPlayer = $(this).data('id');
      var $spanBadge = $(this).find('span.badge');

      $.get(apiWhispers, {
        'forPlayer.id': [idPlayer],
        'toPlayer.id': [currentIdPlayer],
        'isread': false
      }, 'json').done(function (whisps) {
        var nbWhisp = whisps.length;

        $spanBadge.empty();
        if (nbWhisp) {
          $spanBadge.append(nbWhisp);
        }
      }).fail(function (data) {
        console.error("error: ajax apiWhispers: " + data);
      });
    });

    setTimeout(checkWhispers, 5000);
  }

  $('#whisp-tab a').on('click', function (e) {
    e.preventDefault();
    clearTimeout(checkWhisp);

    $(this).tab('show');
    initWhispersPlayer($(this).data('id'));
    $('#send-whisp').removeClass('hide');

    checkWhisp = setTimeout(checkHavWhisp, 2000);
  });

  $('#button-send-whisp').on('click', function () {
    var whisp = $('#text-send-whisp').val();
    var currentIdPlayerWhisp = $('.nav-item.active .nav-link').data('id');

    insertWhisp(whisp, currentIdPlayerWhisp);
  });

  checkWhispers();
 });