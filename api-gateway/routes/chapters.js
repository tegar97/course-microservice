var express = require("express");
const verifyToken = require("../middleware/verifyToken");
const chapterHandler = require("./handler/chapters");

var router = express.Router();
/* GET users listing. */
router.post("/", chapterHandler.create);
router.get("/", chapterHandler.getAll);
router.get("/:id", chapterHandler.get);
router.put("/:id", chapterHandler.update);
router.delete("/:id", chapterHandler.destroy);

module.exports = router;
