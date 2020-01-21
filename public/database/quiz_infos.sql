-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhaku
-- Generation Time: 2020-01-21 15:11:50.5210
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."quiz_infos";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."quiz_infos" (
    "id" uuid NOT NULL,
    "entry_fee" int4 NOT NULL DEFAULT 0,
    "total_participants" int4 NOT NULL DEFAULT 100,
    "total_winners" int4 NOT NULL DEFAULT 10,
    "all_questions_count" int4 NOT NULL DEFAULT 50,
    "answerable_questions_count" int4 NOT NULL DEFAULT 10,
    "distribution" json,
    "expiry" int4 NOT NULL DEFAULT 1,
    "reading" int4 NOT NULL DEFAULT 15,
    "time" int4 NOT NULL DEFAULT 10,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

-- Column Comment
COMMENT ON COLUMN "public"."quiz_infos"."expiry" IS 'expiry in hours';
COMMENT ON COLUMN "public"."quiz_infos"."reading" IS 'reading in minutes';
COMMENT ON COLUMN "public"."quiz_infos"."time" IS 'time in seconds';

INSERT INTO "public"."quiz_infos" ("id", "entry_fee", "total_participants", "total_winners", "all_questions_count", "answerable_questions_count", "distribution", "expiry", "reading", "time", "created_at", "updated_at") VALUES ('35518951-0458-4ad1-b99f-38fe44fa7c15', '10', '20', '5', '50', '10', '[{"rank":"1","price":"40","row_id":"eakt5i4r4"},{"rank":"2","price":"30","row_id":"jt6lv6nv0"},{"rank":"3","price":"20","row_id":"uaj7b8nu3"},{"rank":"4","price":"20","row_id":"a93cxge0t"},{"rank":"5","price":"10","row_id":"hhtuf0gpn"}]', '1', '15', '10', '2020-01-21 09:39:57', '2020-01-21 09:40:55');
