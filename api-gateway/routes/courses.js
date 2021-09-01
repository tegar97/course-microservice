var express = require("express");
const verifyToken = require("../middleware/verifyToken");
const courseHandler = require("./handler/course");

var router = express.Router();
/* GET users listing. */
router.get("/", courseHandler.getAll);
router.get("/:id", courseHandler.get);

router.post("/", verifyToken, courseHandler.create);
router.put("/:id", verifyToken, courseHandler.update);
router.delete("/:id", verifyToken, courseHandler.destroy);

module.exports = router;
