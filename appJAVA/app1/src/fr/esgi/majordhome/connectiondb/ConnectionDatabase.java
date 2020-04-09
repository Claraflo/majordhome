package fr.esgi.majordhome.connectiondb;

import java.sql.*;

public class ConnectionDatabase {


    private static final String URL = "jdbc:mysql://localhost:8889/majordhome?serverTimezone=UTC";
    private static final String USER = "root";
    private static final String PASSWORD = "root";
    private static Connection connect;

    public Connection connectionDb() {

        if (connect == null) {
            try {

                Connection connect = DriverManager.getConnection(URL, USER, PASSWORD);

            } catch (SQLException e) {

                System.out.println(e.getMessage());

            }
        }

        return connect;

    }



}



