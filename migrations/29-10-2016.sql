ALTER TABLE `Events` DROP ` id_organization `;

CREATE TABLE `Organization_Events` (
  `id_organization` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;