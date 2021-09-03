var express = require("express");
const verifyToken = require("../middleware/verifyToken");
const imageCourseHandler = require("./handler/image-course");

var router = express.Router();
/* GET users listing. */
router.post("/", verifyToken, imageCourseHandler.create);
router.delete("/:id", verifyToken, imageCourseHandler.destory);

module.exports = router;
