jQuery(function () {
  var genrateDate = function (time) {
    var toInt = function (i) {
      return +i;
    };
    var date = (new Date()).toJSON().substr(0, 10).split('-').map(toInt);
    time = time.split(':').map(toInt);
    return new Date(date[0], date[1] - 1, date[2], time[0], time[1], time[2]);
  };
  var data = [
    {
      name: 'Day 1',
      points: [

        {
          filled: true,
          img: 'image/timeline/avatar-01.png',
          time: genrateDate('09:00:00'),
          speaker: {
            name: 'Adrian Smith',
            img: 'image/timeline/point-01.png',
            job: 'IT & Network',
          },
          desc: 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        },
        {
            filled: false,
            img: 'image/timeline/avatar-01.png',
            time: genrateDate('08:00:00'),
            speaker: {
                name: 'Adrian Smith',
                img: 'image/timeline/point-01.png',
                job: 'IT & Network',
            },
            desc: 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        },
          {
              filled: false,
              img: 'image/timeline/avatar-01.png',
              time: genrateDate('08:30:00'),
              speaker: {
                  name: 'Adrian Smith',
                  img: 'image/timeline/point-01.png',
                  job: 'IT & Network',
              },
              desc: 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
          },
        {
          filled: true,
          time: genrateDate('10:00:00'),
          speaker: {
            name: 'Adrian Smith',
            img: 'image/timeline/point-01.png',
            job: 'IT & Network',
          },
          desc: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.'
        },
        {
          filled: true,
          time: genrateDate('10:30:00'),
          speaker: {
            name: 'Adrian Smith',
            img: 'image/timeline/point-01.png',
            job: 'IT & Network',
          },
          desc: 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        },
        {
          filled: false,
          time: genrateDate('11:30:00'),
          speaker: {
            name: 'Adrian Smith',
            img: 'image/timeline/point-01.png',
            job: 'IT & Network',
          },
          desc: 'Sunt in culpa qui officia deserunt mollit anim id est laborum.'
        },
        {
          filled: true,
          time: genrateDate('12:15:00'),
          title: 'Lunch',
          desc: 'Lunch time!'
        },
        {
          filled: false,
          time: genrateDate('13:15:00'),
        },
        {
          filled: true,
          img: 'image/timeline/point-02.png',
          time: genrateDate('14:00:00'),
          speaker: {
            name: 'Sarah Spencer',
            img: 'image/timeline/point-02.png',
            job: 'Designer'
          },
          desc: 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        },
        {
          filled: true,
          time: genrateDate('15:00:00'),
          speaker: {
            name: 'Sarah Spencer',
            img: 'image/timeline/point-02.png',
            job: 'Designer'
          },
          desc: 'Excepteur sint occaecat cupidatat non proident.'
        },
      ]
    },
    {
      name: 'Day 2',
      points: [
        {
          filled: true,
          img: 'image/timeline/point-01.png',
          time: genrateDate('09:00:00'),
          speaker: {
            name: 'Emma Henry',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Cillum dolore eu fugiat nulla pariatur, excepteur sint occaecat cupidatat.'
        },
        {
          filled: true,
          time: genrateDate('10:30:00'),
          speaker: {
            name: 'Emma Henry',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Duis aute irure dolor in reprehenderit in voluptate velit esse.'
        },
        {
          filled: false,
          time: genrateDate('11:30:00'),
          speaker: {
            name: 'Emma Henry',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        },
        {
          filled: true,
          time: genrateDate('12:00:00'),
          title: 'Lunch',
          desc: 'Lunch time!'
        },
        {
          filled: false,
          time: genrateDate('13:00:00')
        },
        {
          filled: true,
          img: 'image/timeline/point-01.png',
          time: genrateDate('14:00:00'),
          speaker: {
            name: 'Arthur Reed',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Incididunt ut labore et dolore ut enim ad minim veniam.'
        },
        {
          filled: true,
          time: genrateDate('14:30:00'),
          speaker: {
            name: 'Arthur Reed',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Aliquip aute irure dolor in reprehenderit in voluptate velit.'
        },
        {
          filled: true,
          time: genrateDate('15:00:00'),
          speaker: {
            name: 'Arthur Reed',
            img: 'image/timeline/point-01.png',
            job: 'Developer'
          },
          desc: 'Voluptate velit esse cillum dolore eu fugiat.'
        },
      ]
    },
    {
      name: 'Day 3',
      points: [
        {
          filled: true,
          img: 'image/timeline/point-02.png',
          time: genrateDate('09:00:00'),
          speaker: {
            name: 'Christian Mitchell',
            img: 'image/timeline/point-02.png',
            job: 'DB Manager'
          },
          desc: 'Cupidatat non proident, sunt in culpa qui officia deserunt mollit.'
        },
        {
          filled: true,
          time: genrateDate('10:00:00'),
          speaker: {
            name: 'Christian Mitchell',
            img: 'image/timeline/point-02.png',
            job: 'DB Manager'
          },
          desc: 'Cillum dolore eu fugiat nulla pariatur.'
        },
        {
          filled: true,
          time: genrateDate('11:00:00'),
          speaker: {
            name: 'Christian Mitchell',
            img: 'image/timeline/point-02.png',
            job: 'DB Manager'
          },
          desc: 'Lorem ipsum dolor sit amet sed do eiusmod tempor incididunt.'
        },
      ]
    }
  ];
  var speakerTmpl =
    '<a href="javascript:void(0)" class="speaker">' +
      '<img src="{img}" alt="">' +
      '<div class="speaker-inner">' +
        '<h3 class="speaker-name">{name}</h3>' +
        '<span class="speaker-job">{job}</span>' +
      '</div>' +
    '</a>';

  var pad = function (num, count) {
      return ((new Array(count + 1)).join('0') + num).slice(count * -1);
  };

  var dateFormat = function (date) {
    return pad(date.getHours(), 2) + ':' + pad(date.getMinutes(), 2);
  };

  var selectPoint = function (pointData, timelineData) {
    // Set point title
    var $pointTitleElem = jQuery('#point-title');
    var title = '';
    if (pointData.title) {
      title += pointData.title + ' at ';
    }
    title += dateFormat(new Date(pointData.time)) + ' - ' + timelineData.name;
    $pointTitleElem.text(title);

    // Set point description
    jQuery('#point-desc').text(pointData.desc);

    // Set speakers
    var $speakersTitleElem = jQuery('#speakers-title');
    var $speakersElem = jQuery('#speakers');
    $speakersElem.empty();
    if (pointData.speaker) {
      $speakersTitleElem.removeClass('hidden');

      var template = speakerTmpl.replace('{img}', pointData.speaker.img)
        .replace('{name}', pointData.speaker.name)
        .replace('{job}', pointData.speaker.job);
      $speakersElem.append(template);
    } else {
      $speakersTitleElem.addClass('hidden');
    }
  };

  var $timelinzElem = jQuery('#timeline')[0];
  var timelinz = new Timelinz(data, {
    intervalUnit: 'hour',
    extraIntervals: [0, 0],
    marginBetweenLines: 70,
    intervalFormat: dateFormat,

    onLineRendered: function (lineElem, lineData) {
      // Add timeline title
      var template = '<h4 class="timelinz__line-title">{name}</h4>'.replace('{name}', lineData.name);
      jQuery(lineElem).prepend(template);
    },

    onPointRendered: function (pointElem, pointData, timelineData) {
      var $pointElem = jQuery(pointElem);
      // Set tooltip
      var tooltip = dateFormat(new Date(pointData.time));
      if (pointData.title) {
        tooltip += ' - ' + pointData.title;
      } else {
        tooltip += pointData.speaker ? ' - ' + pointData.speaker.name : '';
      }
      $pointElem.addClass('tooltip-left')
        .attr('data-tooltip', tooltip);

      // Append <span> to normal points
      if (!pointData.img) {
        $pointElem.append(document.createElement('span'));
      }
    },

    onPointClicked: function (e, pointData, timelineData) {
      e.preventDefault();
      selectPoint(pointData, timelineData);
    },

    onRenderCompleted: function () {
      // Choose default point
      selectPoint(data[0].points[0], data[0]);
    }
  });
  timelinz.render($timelinzElem);
});
