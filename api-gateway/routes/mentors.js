const express = require("express");
const mentorHandler = require("./handler/mentors");
const router = express.Router();
/* GET users listing. */
router.get("/", mentorHandler.getAll);
router.get("/:id", mentorHandler.get);
router.post("/", mentorHandler.create);

module.exports = router;
