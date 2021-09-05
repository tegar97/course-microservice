module.exports = (...roles) => {
  return (req, res, next) => {
    const role = req.user.data.role;
    console.log(role);
    console.log(!roles.includes(role));
    if (!roles.includes(role)) {
      return res.status(405).json({
        status: "error",
        message: "You dont have permission",
      });
    }
    return next();
  };
};
