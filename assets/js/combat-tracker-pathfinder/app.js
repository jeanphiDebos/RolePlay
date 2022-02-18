/*
 * not need look autoProvideVariables in webpack.config.js
 * const $ = require('jquery');
 */
require('bootstrap-sass');

$.ajaxSetup({
  contentType: 'application/json; charset=utf-8'
});

$(document).ready(function () {
  var $listingSelectedEncounter = $('#listing-selected-encounter');
  var $pathfinderRound = $('#pathfinder-round');
  var $pathfinderTotalXP = $('#pathfinder-total-xp');
  var $pathfinderTypeEncounter = $('#pathfinder-type-encounter');

  var $protoEncounter = $('#proto-selected-encounter-item');
  var $protoEncounterPlayer = $('#proto-selected-encounter-item-player');
  var $protoEncounterBestiary = $('#proto-selected-encounter-item-bestiary');

  var $listEncounterPlayer = $('#list-selected-encounter-item-player');
  var $listEncounterBestiary = $('#list-selected-encounter-item-bestiary');

  var $selectPlayer = $('#select-encounter-item-player');
  var $selectBestiary = $('#select-encounter-item-bestiary');
  
  var $modalSheetBestiary = $('#modal-sheet-bestiary');
  var $modalSheetBestiaryTitre = $('#sheet-bestiary-info-titre');
  var $modalSheetBestiaryImage = $('#sheet-bestiary-info-image');

  function showModalSheetBestiary(nameBestiary, sheetBestiary)
  {
    $modalSheetBestiaryTitre.empty().append(nameBestiary);
    $modalSheetBestiaryImage.attr('src', sheetBestiary);
    $modalSheetBestiary.modal();
  }

  function calculeXPBestiary(lvlBestiary, lvlAveragePlayes)
  {
    lvlBestiary = Math.floor(lvlBestiary);
    lvlAveragePlayes = Math.floor(lvlAveragePlayes);

    deltalvl = lvlBestiary - lvlAveragePlayes;

    if (deltalvl <= -4) {
      return 10;
    } else if (deltalvl == -3) {
      return 15;
    } else if (deltalvl == -2) {
      return 20;
    } else if (deltalvl == -1) {
      return 30;
    } else if (deltalvl == 0) {
      return 40;
    } else if (deltalvl == 1) {
      return 60;
    } else if (deltalvl == 2) {
      return 80;
    } else if (deltalvl == 3) {
      return 120;
    } else if (deltalvl >= 4) {
      return 160;
    }
  }

  function calculeTypeEncounter(totalXP, encounterPlayers)
  {
    if (totalXP < 15*encounterPlayers) {
      return 'Triviale';
    } else if (totalXP < 20*encounterPlayers) {
      return 'Faible';
    } else if (totalXP < 30*encounterPlayers) {
      return 'Moderee';
    } else if (totalXP < 40*encounterPlayers) {
      return 'Serieuse';
    } else {
      return 'Extreme';
    }
  }

  $('#add-encounter-player').on('click', function () {
    var addPlayer = $selectPlayer.val();

    if (addPlayer) {
      $.get(apiPathfinderPlayers + '/' + addPlayer, 'json').done(function (player) {
        try {
          if (player) {
            $newEncounterPlayer = $protoEncounterPlayer.clone();
            $newEncounterPlayerRemove = $newEncounterPlayer.find('.selected-encounter-item-player-remove');

            $newEncounterPlayer.removeClass('hide');
            $newEncounterPlayer.removeAttr('id');
            $newEncounterPlayer.attr('data-id-item', player.id);
            $newEncounterPlayer.data('id-item', player.id);
            $newEncounterPlayer.find('.name').empty().append(player.name + ' (lvl&nbsp;:&nbsp;' + player.level + ')');
            $newEncounterPlayer.find('.level').val(player.level);
            $newEncounterPlayer.find('.initiation').val(player.initiation);
            $newEncounterPlayer.find('.pv').empty().append(player.lifePoint);
            $newEncounterPlayer.find('.selected-encounter-item-player-remove')
            $newEncounterPlayerRemove.data('id-item', player.id)
            $newEncounterPlayerRemove.attr('data-id-item', player.id);
            $listEncounterPlayer.append($newEncounterPlayer);

            $selectPlayer.find("option[value='"+addPlayer+"']").attr('disabled','disabled');
            $selectPlayer.val('');

            $newEncounterPlayerRemove.click(function () {
              id = $(this).attr('data-id-item');
              $(this).closest('.selected-encounter-item').remove();
              $selectPlayer.find("option[value='" + id + "']").removeAttr('disabled');
            });
          }
        } catch (e) {
          console.error('error: ajax apiPathfinderPlayers: ' + e);
        }
      }).fail(function (data) {
        console.error('error: ajax apiPathfinderPlayers: ' + data);
      });
    }
  });
  
  $('#add-encounter-bestiary').on('click', function () {
    var addBestiary = $selectBestiary.val();

    if (addBestiary) {
      $.get(apiPathfinderBestiaries + '/' + addBestiary, 'json').done(function (bestiarie) {
        try {
          if (bestiarie) {
            $newEncounterBestiary = $protoEncounterBestiary.clone();
            $newEncounterBestiaryRemove = $newEncounterBestiary.find('.selected-encounter-item-bestiary-remove');

            $newEncounterBestiary.attr('data-id-item', bestiarie.id);
            $newEncounterBestiary.data('id-item', bestiarie.id);
            $newEncounterBestiary.find('.name').empty().append(bestiarie.name + ' (lvl&nbsp;:&nbsp;' + bestiarie.level + ')');
            $newEncounterBestiary.find('.level').val(bestiarie.level);
            $newEncounterBestiary.find('.initiation').val(bestiarie.initiation).attr('disabled','disabled');
            $newEncounterBestiary.find('.pv').empty().append(bestiarie.lifePoint);
            $newEncounterBestiary.find('.info').val(bestiarie.info);
            $newEncounterBestiary.find('.sheet').val(bestiarie.sheet);
            $newEncounterBestiaryRemove.data('id-item', bestiarie.id);
            $newEncounterBestiaryRemove.attr('data-id-item', bestiarie.id);
            $newEncounterBestiary.removeClass('hide');
            $listEncounterBestiary.append($newEncounterBestiary);

            $newEncounterBestiaryRemove.click(function () {
              $(this).closest('.selected-encounter-item').remove();
            });
          }
        } catch (e) {
          console.error('error: ajax apiPathfinderBestiaries: ' + e);
        }
      }).fail(function (data) {
        console.error('error: ajax apiPathfinderBestiaries: ' + data);
      });
    }
  });

  $('#clear-combat-tracker').on('click', function () {
    $listingSelectedEncounter.empty();
    $pathfinderRound.empty().append(0);
    $pathfinderTotalXP.empty().append(0);
    $listEncounterBestiary.empty();
  });

  $('#start-combat-tracker').on('click', function () {
    var lvlPlayers = 0;
    var totalXP = 0;
    var totalXP = 0;
    var listencounter = [];
    $listingSelectedEncounter.empty();

    $listEncounterPlayer.find('.selected-encounter-item').each(function() {
      listencounter.push({
        'id': $(this).attr('data-id-item'),
        'name': $(this).find('.name').text(),
        'level': $(this).find('.level').val(),
        'initiation': $(this).find('.initiation').val(),
        'lifePoint': $(this).find('.pv').text()
      });

      lvlPlayers += Math.floor($(this).find('.level').val());
    });

    nbPlayers = listencounter.length;
    lvlAveragePlayes = Math.floor(lvlPlayers/nbPlayers);

    $listEncounterBestiary.find('.selected-encounter-item').each(function() {
      roleBestiary = (Math.floor(Math.random() * 19) + 1);
      listencounter.push({
        'id': $(this).attr('data-id-item'),
        'name': $(this).find('.name').text(),
        'level': $(this).find('.level').val(),
        'roleBestiary': roleBestiary,
        'initiation': (roleBestiary + Math.floor($(this).find('.initiation').val())),
        'lifePoint': $(this).find('.pv').text(),
        'info': $(this).find('.info').val(),
        'sheet': $(this).find('.sheet').val()
      });

      totalXP += calculeXPBestiary(Math.floor($(this).find('.level').val()), lvlAveragePlayes);
    });


    var listencounter = listencounter.sort(function(a, b) {
      return a.initiation - b.initiation;
    }).reverse();

    maxEncounter = listencounter.length;
    listencounter.forEach(function(encounter,index){
      $newEncounter = $protoEncounter.clone();
      $newEncounter.attr('data-id-item', encounter.id);
      $newEncounter.data('id-item', encounter.id);
      $newEncounter.find('.name').empty().append(encounter.name);
      $newEncounter.find('.initiation div').empty().append(encounter.initiation);
      if (encounter.roleBestiary) {
        $newEncounter.find('.initiation div').append('<br>(' + encounter.roleBestiary + ')');
      }
      $newEncounter.find('.current-pv input').val(encounter.lifePoint);
      $newEncounter.find('.pv').empty().append(encounter.lifePoint);
      $newEncounter.removeClass('hide');

      if (encounter.info) {
        $newEncounter.find('.info-encounter').attr('data-content', encounter.info).removeClass('hide').popover();
      }

      if (encounter.sheet) {
        $newEncounter.find('.sheet-encounter').removeClass('hide').on('click', function () {
          showModalSheetBestiary(encounter.name, encounter.sheet)
        });
      }

      if (index==0) {
        $newEncounter.find('.current-played').removeClass('hide').addClass('is-current-played').addClass('is-first-encounter');
      }

      if (index==maxEncounter-1) {
        $newEncounter.find('.current-played').addClass('is-last-encounter');
      }

      $listingSelectedEncounter.append($newEncounter);
    });

    $pathfinderRound.empty().append(1);
    $pathfinderTotalXP.empty().append(totalXP);
    $pathfinderTypeEncounter.empty().append('(' + calculeTypeEncounter(totalXP, nbPlayers) + ')');
  });

  $('#next-combat-tracker').on('click', function () {
    var $isCurrentPlayed = $('.is-current-played');
    $isCurrentPlayed.addClass('hide').removeClass('is-current-played');
    if ($isCurrentPlayed.hasClass('is-last-encounter')) {
      $isCurrentPlayed.closest('#listing-selected-encounter').find('.is-first-encounter').removeClass('hide').addClass('is-current-played');
      var currentRound = Math.floor($pathfinderRound.text());
      $pathfinderRound.empty().append(currentRound+1);
    } else {
      $isCurrentPlayed.closest('tr.selected-encounter-item').next().find('.current-played').removeClass('hide').addClass('is-current-played');
    }
  });

  $('#collapseSelectEncounter').on('hidden.bs.collapse', function () {
    $('.glyphicon.glyphicon-resize-full').addClass('hide');
    $('.glyphicon.glyphicon-resize-small').removeClass('hide');
    $('#block-encounter').removeClass('col-md-5').addClass('col-md-11');
  });

  $('#collapseSelectEncounter').on('show.bs.collapse', function () {
    $('.glyphicon.glyphicon-resize-small').addClass('hide');
    $('.glyphicon.glyphicon-resize-full').removeClass('hide');
    $('#block-encounter').removeClass('col-md-11').addClass('col-md-5');
  });

  $('#collapseSelectEncounter').collapse('show');
});
