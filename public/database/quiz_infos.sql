-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhakoo
-- Generation Time: 2020-01-04 08:42:14.7860
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
    "image" text NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

INSERT INTO "public"."quiz_infos" ("id", "entry_fee", "total_participants", "total_winners", "all_questions_count", "answerable_questions_count", "image", "created_at", "updated_at") VALUES ('734c8844-cbdf-4e42-ae8c-469cb486d97f', '10', '100', '10', '50', '10', 'dMrYL6F4mOreb0Cq0IB8bBG06RiV859Phg0vr2Tn.jpeg', '2020-01-04 03:08:58', '2020-01-04 03:08:58'),
('d684cb75-4a03-45f9-8d37-b8a7f6cd0c56', '20', '100', '10', '50', '10', 'MN9VcF7L4Pevmzh557cWyCcAhVTfxs0iwK07Dhqa.jpeg', '2020-01-04 03:10:10', '2020-01-04 03:10:10'),
('df319c45-35dc-4ff8-bc77-c1dd6af781ff', '50', '100', '10', '50', '10', '4NQIp4HX7RmonQeJXVBdDCZMiJC1aSYMcphq46HH.jpeg', '2020-01-04 03:11:02', '2020-01-04 03:11:02'),
('e3c32daa-cf6a-46d4-9051-d91306088f0e', '30', '100', '10', '50', '10', 'KD9oHVeN9xJNzCrAZSX78GHH2qOYpXNQYd6pUeUg.jpeg', '2020-01-04 03:10:26', '2020-01-04 03:10:26'),
('e91370dc-cb69-4c24-9f5f-ba4b2e28eb02', '100', '1000', '50', '100', '20', 'aORcxXV9Mp3NiwtD3C5YRnM71nd28YiyvftB7g13.jpeg', '2020-01-04 03:11:26', '2020-01-04 03:11:26');
