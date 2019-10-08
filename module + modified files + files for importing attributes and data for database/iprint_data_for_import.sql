TRUNCATE TABLE `ps_iprint_clients`;
TRUNCATE TABLE `ps_iprint_clips`;
TRUNCATE TABLE `ps_iprint_folding`;
TRUNCATE TABLE `ps_iprint_formt`;
TRUNCATE TABLE `ps_iprint_glue`;
TRUNCATE TABLE `ps_iprint_main`;
TRUNCATE TABLE `ps_iprint_paper`;
TRUNCATE TABLE `ps_iprint_papertype`;
TRUNCATE TABLE `ps_iprint_print`;
TRUNCATE TABLE `ps_iprint_saved`;
TRUNCATE TABLE `ps_iprint_sewing`;
TRUNCATE TABLE `ps_iprint_special`;
TRUNCATE TABLE `ps_iprint_bundling`;
TRUNCATE TABLE `ps_iprint_proof`;
TRUNCATE TABLE `ps_iprint_productiontime`;

INSERT INTO `ps_iprint_clips` (`id`, `printer`, `circulation`, `price`, `sheets`, `paper`) VALUES
(1, 'mediaprint', 1000, 25000, NULL, NULL),
(2, 'mediaprint', 10000, 65000, NULL, NULL),
(3, 'mediaprint', 100000, 513000, NULL, NULL);


INSERT INTO `ps_iprint_folding` (`id`, `printer`, `circulation`, `price`, `pages`, `paper`) VALUES
(1, 'mediaprint', 1000, 82000, NULL, NULL),
(2, 'mediaprint', 10000, 180000, NULL, NULL),
(3, 'mediaprint', 100000, 1067500, NULL, NULL);

INSERT INTO `ps_iprint_formt` (`id`, `Format`, `Area`, `m`, `maxp`) VALUES
(1, 'A4 (21 x 29.7 cm)', 0.5632000000, 'default', 8),
(2, 'A5 (14.8 x 21 cm)', 0.5632000000, 'default', 16),
(3, 'B5 (16.8 x 24 cm)', 0.7000000000, 'default', 16),
(4, 'C6 (10 x 21 cm)', 0.5632000000, 'default', 24);

INSERT INTO `ps_iprint_glue` (`id`, `printer`, `circulation`, `price`) VALUES
(1, 'mediaprint', 1000, 300000),
(2, 'mediaprint', 10000, 1230000),
(3, 'mediaprint', 100000, 9480000);

INSERT INTO `ps_iprint_paper` (`id`, `printer`, `circulation`, `price`) VALUES
(1, 'mediaprint', 1000, 3000000),
(2, 'mediaprint', 10000, 22000000),
(3, 'mediaprint', 100000, 205000000);

INSERT INTO `ps_iprint_papertype` (`id`, `name`, `printer`, `price`) VALUES
(1, 'standart', 'mediaprint', 1680);

INSERT INTO `ps_iprint_print` (`id`, `color`, `m`, `printer`, `circulation`, `price`) VALUES
(1, 1, 'default', 'mediaprint', 1000, 164000),
(2, 1, 'default', 'mediaprint', 10000, 364000),
(3, 1, 'default', 'mediaprint', 100000, 1885000),
(4, 2, 'default', 'mediaprint', 1000, 276800),
(5, 2, 'default', 'mediaprint', 10000, 516800),
(6, 2, 'default', 'mediaprint', 100000, 2342000),
(7, 4, 'default', 'mediaprint', 1000, 453750),
(8, 4, 'default', 'mediaprint', 10000, 768750),
(9, 4, 'default', 'mediaprint', 100000, 3918750),
(10, 5, 'default', 'mediaprint', 1000, 679200),
(11, 5, 'default', 'mediaprint', 10000, 1239200),
(12, 5, 'default', 'mediaprint', 100000, 5498000);

INSERT INTO `ps_iprint_sewing` (`id`, `printer`, `circulation`, `price`, `sheets`, `paper`) VALUES
(1, 'mediaprint', 1000, 32500, NULL, NULL),
(2, 'mediaprint', 10000, 117500, NULL, NULL),
(3, 'mediaprint', 100000, 1175000, NULL, NULL);

INSERT INTO `ps_iprint_special` (`id`, `type`, `printer`, `area`, `price`) VALUES
(1, 'Gloss lamination', 'mediaprint', 10, 100000),
(2, 'Gloss lamination', 'mediaprint', 5632, 1775000),
(3, 'Gloss lamination', 'mediaprint', 56320, 17200000),
(4, 'Matte lamination', 'mediaprint', 10, 150000),
(5, 'Matte lamination', 'mediaprint', 5632, 3215000),
(6, 'Matte lamination', 'mediaprint', 56320, 32000000),
(7, 'UV varnish', 'mediaprint', 10, 100000),
(8, 'UV varnish', 'mediaprint', 3000, 670000),
(9, 'UV varnish', 'mediaprint', 30000, 5350000),
(10, 'None', 'mediaprint', 0, 0);

INSERT INTO `ps_iprint_bundling` (`id`, `printer`, `circulation`, `price`) VALUES
(1, 'mediaprint', 1000, 164000),
(2, 'mediaprint', 10000, 364000),
(3, 'mediaprint', 100000, 1885000);


INSERT INTO `ps_iprint_proof` (`id`, `printer`, `circulation`, `price`) VALUES
(1, 'mediaprint', 1000, 164000),
(2, 'mediaprint', 10000, 364000),
(3, 'mediaprint', 100000, 1885000);

INSERT INTO `ps_iprint_productiontime` (`id`, `printer`, `circulation`, `price`) VALUES
(1, 'mediaprint', 1000, 164000),
(2, 'mediaprint', 10000, 364000),
(3, 'mediaprint', 100000, 1885000);
