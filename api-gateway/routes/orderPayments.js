var express = require("express");
var router = express.Router();
const orderPaymentHandler = require("./handler/order-payment");
/* GET users listing. */
router.get("/", orderPaymentHandler.getOrders);

module.exports = router;
