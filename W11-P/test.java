import java.sql.*;

public class Test {
    private static String className = "oracle.jdbc.driver.OracleDriver";
    private static String url = "jdbc:oracle:thin:@localhost:1521:xe";
    private static String user = "hr";
    private static String password = "1234";

    public Connection getConnection() {

        Connection conn = null;

        try {
            Class.forName(className);
            conn = DriverManager.getConnection(url, user, password);
            System.out.println("connection success");
        } catch (ClassNotFoundException cnfe) {
            System.out.println("failed db driver loading\n" + cnfe.toString());
        } catch (SQLException sqle) {
            System.out.println("failed db connection\n" + sqle.toString());
        } catch (Exception e) {
            System.out.println("Unknown error");
            e.printStackTrace();
        }

        return conn;

    }

    public void closeAll(Connection conn, PreparedStatement pstm, ResultSet rs) {

        try {
            if (rs != null) rs.close();
            if (pstm != null) pstm.close();
            if (conn != null) conn.close();
            System.out.println("All Closed");
        } catch (SQLException sqle) {
            System.out.println("Error!!");
            sqle.printStackTrace();
        }

    }

    private void select() {

        Connection conn = null;
        PreparedStatement psmt = null;
        ResultSet rs = null;

        String sql = "select e.* from ( select a.* from departments a order by a.department_id desc ) e where rownum = 1";

        try {
            conn = getConnection();
            psmt = conn.prepareStatement(sql);
            rs = psmt.executeQuery();
            while (rs.next()) {
                System.out.print("department_id: " + rs.getString("department_id"));
                System.out.print("\tdepartment_name: " + rs.getString("department_name"));
                System.out.println("\tlocation_id: " + rs.getString("location_id"));
            }
        } catch(SQLException e) {
            e.printStackTrace();
        } finally {
            this.closeAll(conn, psmt, rs);
        }

    }

    private void update() {

        Connection conn = null;
        PreparedStatement psmt = null;
        ResultSet rs = null;

        String sql = "UPDATE departments SET LOCATION_ID = 1700  where DEPARTMENT_ID = 280";

        try {
            conn = this.getConnection();
            psmt = conn.prepareStatement(sql);
            int count = psmt.executeUpdate();
            System.out.println(count + " row updated");
            psmt.close();
        } catch(SQLException e) {
            e.printStackTrace();
        } finally {
            this.closeAll(conn, psmt, rs);
        }

    }

    private void insert() {

        Connection conn = null;
        PreparedStatement psmt = null;
        ResultSet rs = null;

        String sql = "INSERT INTO departments VALUES (280, 'CONTENTS DEVELOPMENT', NULL, 1800)";

        try {
            conn = this.getConnection();
            psmt = conn.prepareStatement(sql);
            int count = psmt.executeUpdate();
            System.out.println(count + " row inserted");
            psmt.close();
        } catch(SQLException e) {
            e.printStackTrace();
        } finally {
            this.closeAll(conn, psmt, rs);
        }

    }

    private void delete() {

        Connection conn = null;
        PreparedStatement psmt = null;
        ResultSet rs = null;

        String sql = "DELETE FROM DEPARTMENTS WHERE DEPARTMENT_ID = 280";

        // 오라클에 쿼리 전송 및 결과값 반환
        try {
            conn = this.getConnection();
            psmt = conn.prepareStatement(sql);
            int count = psmt.executeUpdate();
            System.out.println(count + " row delete");
            psmt.close();
        } catch(SQLException e) {
            e.printStackTrace();
        } finally {
            this.closeAll(conn, psmt, rs);
        }

    }

    public static void main(String[] args) {

        Test so = new Test();
        so.select();
        so.insert();
        so.select();
        so.update();
        so.select();
        so.delete();
        so.select();

    }
}
