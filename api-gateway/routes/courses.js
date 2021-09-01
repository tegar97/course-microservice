var express = require("express");
const courseHandler = require("./handler/course");

var router = express.Router();
/* GET users listing. */
router.get("/", courseHandler.getAll);
router.get("/:id", courseHandler.get);
router.post("/", courseHandler.create);
router.put("/:id", courseHandler.update);
router.delete("/:id", courseHandler.destroy);

module.exports = router;
