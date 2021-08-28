module.exports = (Sequelize, DataTypes) => {
  const Media = Sequelize.define(
    "Media",
    {
      id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true,
        allowNull: false,
      },
      image: {
        type: DataTypes.STRING,
        allowNull: false,
      },
      createdAt: {
        field: "created_at",
        type: DataTypes.DATE,
        allowNull: false,
      },
      updateAt: {
        field: "updaet_at",
        type: DataTypes.DATE,
        allowNull: false,
      },
    },
    {
      tableName: "media",
    }
  );
};
