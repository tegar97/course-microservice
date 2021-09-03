const express = require("express");
const lessonHandler = require("./handler/lessons");
const router = express.Router();
/* GET users listing. */
router.get("/", lessonHandler.getAll);
router.get("/:id", lessonHandler.get);
router.post("/", lessonHandler.create);
router.put("/:id", lessonHandler.update);
router.delete("/:id", lessonHandler.destory);

module.exports = router;
