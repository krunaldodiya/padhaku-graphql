-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhaku
-- Generation Time: 2020-02-01 09:53:13.5970
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."topics";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."topics" (
    "id" uuid NOT NULL,
    "name" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

INSERT INTO "public"."topics" ("id", "name", "created_at", "updated_at") VALUES ('012c9893-1685-4b4b-be8a-bf8fadf2dfc0', 'public', '2020-02-01 04:21:45', '2020-02-01 04:21:45');
