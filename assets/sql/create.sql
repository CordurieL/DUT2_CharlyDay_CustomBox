DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
    `user_id`  INT                 NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom`      VARCHAR(255),
    `prenom`   VARCHAR(255),
    `email`    VARCHAR(255) unique NOT NULL,
    `password` VARCHAR(255)        NOT NULL
)