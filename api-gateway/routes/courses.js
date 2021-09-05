var express = require("express");
const verifyToken = require("../middleware/verifyToken");
const courseHandler = require("./handler/course");
const can = require("./../middleware/permisson");
var router = express.Router();
/* GET users listing. */
router.get("/", courseHandler.getAll);
router.get("/:id", courseHandler.get);

router.post("/", verifyToken, can("admin"), courseHandler.create);
router.put("/:id", verifyToken, can("admin"), courseHandler.update);
router.delete("/:id", verifyToken, can("admin"), courseHandler.destroy);

module.exports = router;
