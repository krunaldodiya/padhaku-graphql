-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhakoo
-- Generation Time: 2020-01-16 18:59:33.2210
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."plans";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."plans" (
    "id" uuid NOT NULL,
    "amount" int4 NOT NULL,
    "coins" int4 NOT NULL,
    "description" text,
    PRIMARY KEY ("id")
);

INSERT INTO "public"."plans" ("id", "amount", "coins", "description") VALUES ('0eb2ffb9-d8bd-4786-9413-e774fc30c7da', '10', '19', NULL),
('579fd2fe-d26b-4bbb-bfb1-78d9d0e8765f', '50', '99', NULL),
('77ccf60c-c680-4e77-9831-1ed9ce228c75', '20', '39', NULL),
('81de5fa4-6e31-4714-8b36-086890762a24', '100', '199', NULL),
('9bf66688-e7a1-4371-b285-f192513372fd', '500', '999', NULL);
