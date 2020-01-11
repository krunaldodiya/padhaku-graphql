-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhaku
-- Generation Time: 2020-01-11 08:56:40.7200
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
    "expiry" int4 NOT NULL DEFAULT 1,
    "reading" int4 NOT NULL DEFAULT 15,
    "seconds" int4 NOT NULL DEFAULT 10,
    PRIMARY KEY ("id")
);

INSERT INTO "public"."quiz_infos" ("id", "entry_fee", "total_participants", "total_winners", "all_questions_count", "answerable_questions_count", "image", "created_at", "updated_at", "expiry", "reading", "seconds") VALUES ('734c8844-cbdf-4e42-ae8c-469cb486d97f', '10', '100', '10', '50', '10', 'W80GiEJFBpB4ueTqiPJAA6Lf2pYBCBTx2Tq9RJCc.jpeg', '2020-01-04 03:08:58', '2020-01-04 03:18:40', '1', '15', '10'),
('d684cb75-4a03-45f9-8d37-b8a7f6cd0c56', '20', '100', '10', '50', '10', 'ZEmpbZHgNeOxI2hNx66k3MAEIeIJMNI1gorJTMcY.jpeg', '2020-01-04 03:10:10', '2020-01-04 03:18:30', '1', '15', '10'),
('df319c45-35dc-4ff8-bc77-c1dd6af781ff', '50', '100', '10', '50', '10', 'bf7uLJMCsHWwXJyDyfJQJBVPeSxqcj2PES7uEXEc.jpeg', '2020-01-04 03:11:02', '2020-01-04 03:18:19', '1', '15', '10'),
('e3c32daa-cf6a-46d4-9051-d91306088f0e', '30', '100', '10', '50', '10', 'BvD6Y9PimruZijKwnGa2vboZVMrQbawK0yTGrM74.jpeg', '2020-01-04 03:10:26', '2020-01-04 03:18:01', '1', '15', '10'),
('e91370dc-cb69-4c24-9f5f-ba4b2e28eb02', '100', '1000', '50', '100', '20', 'tM305iM1O3mESw9nZhcysbPVfTWdfjGLTTLcwVFl.jpeg', '2020-01-04 03:11:26', '2020-01-04 03:17:23', '1', '15', '10');
