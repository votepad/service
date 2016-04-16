
CREATE TABLE IF NOT EXISTS `Blocked` (
  `id_event` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `Online` (
  `id_event` int(18) NOT NULL,
  `id_judge` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `Scores` (
  `id_event` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL,
  `id_judge` int(18) NOT NULL,
  `score` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
