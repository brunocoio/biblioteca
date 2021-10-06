module.exports = {
    // up: async(queryInterface, Sequelize) => {
    // await queryInterface.createTable('alunos', {
    up: (queryInterface, Sequelize) => queryInterface.createTable('users', {
        id: {
            type: Sequelize.INTEGER,
            allowNull: false,
            autoIncrement: true,
            primaryKey: true,
        },
        nome: {
            type: Sequelize.STRING,
            allowNull: false,
        },
        email: {
            type: Sequelize.STRING,
            allowNull: false,
            unique: true,
        },
        password_hash: {
            type: Sequelize.STRING,
            allowNull: false,
        },
        created_at: {
            type: Sequelize.DATE,
            allowNull: false,
        },
        updated_at: {
            type: Sequelize.DATE,
            allowNull: false,
        },
    }),

    // down: async(queryInterface, Sequelize) => {
    //     await queryInterface.dropTable('alunos');
    // },
    down: (queryInterface, Sequelize) => queryInterface.dropTable('users'),
};
