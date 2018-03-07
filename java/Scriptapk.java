/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.io.File;
import java.net.HttpURLConnection;
import java.net.URL;
import java.io.InputStreamReader;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.lang.management.ManagementFactory;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.TimeUnit;
import static javafx.css.StyleOrigin.USER_AGENT;
import javax.net.ssl.HttpsURLConnection;

/**
 *
 * @author manish
 */
public class Scriptapk{

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {   
        Thread t1 =  new Thread( new Runnable(){
            public void run(){
                String serverbaseurl = null;
                String urlParameters = null;
                try{
                        FileWriter logfile = new FileWriter(args[8]+"/"+args[7]+".txt");
                        Runtime r = Runtime.getRuntime();
                        String[] command = {"bash", "build_android_1.sh", args[0], args[1], args[2], args[3], args[4], args[5], args[6], args[7]};
                        Process p = r.exec(command);
                        BufferedReader reader = new BufferedReader(new InputStreamReader(p.getInputStream())); 
                        BufferedWriter writer = new BufferedWriter(logfile);
                        String s;                                                                
                        while ((s = reader.readLine())!= null) {   
                                writer.write(s);
                                writer.newLine();
                                System.out.println("Script output: " + s);
                        }
                        reader.close();
                        p.destroy();
                        File file2 = new File(args[3]+"/"+args[4]+".txt");
                        if ( (file2.exists() && file2.isFile()) ){
                            try{
                            BufferedReader reader1 = new BufferedReader(new FileReader(file2));
                                String line;
                                while ((line = reader1.readLine()) != null){
                                    String[] word = line.split("");
                                    for(String singleWord:word) {
                                        System.out.println(singleWord);
                                        int a = Integer.parseInt(singleWord);
                                        System.out.println(a);
                                        if ( a == 1 )
                                             {
                                                 serverbaseurl = "https://domain_name/appBuild/updateStatus";
                                                 urlParameters = "buildId="+args[7]+"&status=1&string=git clone authentication failed(Access denied)";
                                                 writer.write("git clone authentication failed(Access denied)");
                                                 writer.newLine();
                                             }
                                             else if ( a == 2 )
                                             {
                                                 serverbaseurl = "https://cdomain_name/appBuild/updateStatus";
                                                 urlParameters = "buildId="+args[7]+"&status=1&string=problem with js filename";
                                                 writer.write("problem with js filename");
                                                 writer.newLine();
                                             }
                                    }
                                }
                                reader1.close();
                            }
                            catch(Exception e){
                                System.out.println("Exception: " + e.getMessage());
                            }
                            file2.delete();
                        }
                        else
                        {
                            int maxRetry  = 0; 
                            while(maxRetry <=10){
                                File fileBuildStat = new File(args[5]+"/BuildStatus.txt");
                                    BufferedReader buildStatBuffRdr = new BufferedReader(new FileReader(fileBuildStat));
                                    String strbuildStat;
                                    int buildStat=-1;
                                    while ((strbuildStat = buildStatBuffRdr.readLine()) != null){
                                        String[] wrdBuildStat = strbuildStat.split("");
                                        for(String singleWord1:wrdBuildStat) {
                                             System.out.println(singleWord1);
                                             int a1 = Integer.parseInt(singleWord1);
                                             if ( a1 == 0 )
                                             {
                                                 buildStat = 0;
                                                 break;
                                             }
                                        }

                                    }
                                    if(buildStat == 0){
                                        fileBuildStat.delete();
                                        break;
                                    }
                                    else{
                                        TimeUnit.SECONDS.sleep(45);
                                        maxRetry++;
                                    }
                            }
                            
                       //TimeUnit.MINUTES.sleep(2);
                        File file1 = new File(args[5]+"/platforms/android/build/outputs/apk/android-release-unsigned.apk");
                        if (file1.exists() && file1.isFile()){
                            Runtime r2 = Runtime.getRuntime();
                            String[] command2 = {"bash", "build_android_2.sh", args[0], args[1], args[2], args[3], args[4], args[5], args[6], args[7]};
                            Process p2 = r2.exec(command2);
                            BufferedReader reader2 = new BufferedReader(new InputStreamReader(p2.getInputStream())); 
                            String s2;                                                                
                            while ((s2 = reader2.readLine())!= null){ 
                                    writer.write(s2);
                                    writer.newLine();
                                    System.out.println("Script output: " + s2);
                            }
                            reader2.close();
                            p2.destroy();
                            try{
                                    File file4 = new File(args[3]+"/"+args[4]+".txt");
                                    BufferedReader reader3 = new BufferedReader(new FileReader(file4));
                                    String line1;
                                    while ((line1 = reader3.readLine()) != null){
                                        String[] word1 = line1.split("");
                                        for(String singleWord1:word1) {
                                             System.out.println(singleWord1);
                                             int a1 = Integer.parseInt(singleWord1);
                                             if ( a1 == 0 )
                                             {
                                                 serverbaseurl = "https://domain_name/appBuild/updateStatus";
                                                 urlParameters = "buildId="+args[7]+"&status=0&string=apk file build successfully";
                                                 writer.write("apk file build successfully");
                                                 writer.newLine();
                                             }
                                             else if ( a1 == 3 )
                                             {
                                                 serverbaseurl = "https://domain_name/appBuild/updateStatus";
                                                 urlParameters = "buildId="+args[7]+"&status=1&string=keystore not found";
                                                 writer.write("keystore not found");
                                                 writer.newLine();
                                             
                                             }
                                             else if ( a1 == 4 )
                                             {
                                                 serverbaseurl = "https://domain_name/appBuild/updateStatus";
                                                 urlParameters = "buildId="+args[7]+"&status=1&string=zipalign command failed";
                                                 writer.write("zipalign command failed");
                                                 writer.newLine();
                                             }
                                        }
                                }
                                reader3.close();
                                file4.delete();
                            }
                            catch(Exception e){
                                System.out.println("Exception: " + e.getMessage());
                            }
                        }
                        else{
                            System.out.println("replacing version number");
                            Runtime r3 = Runtime.getRuntime();
                            String[] command3 = {"bash", "build_android_3.sh", args[0], args[1], args[5]};
                            Process p3 = r3.exec(command3);
                            BufferedReader reader4 = new BufferedReader(new InputStreamReader(p3.getInputStream())); 
                            String s3;                                                                
                            while ((s3 = reader4.readLine())!= null){                                
                                    System.out.println("Script output: " + s3);
                            }
                            reader4.close();
                            p3.destroy();
                            serverbaseurl = "https://domain_name/appBuild/updateStatus";
                            urlParameters = "buildId="+args[7]+"&status=1&string=ionic build android failed";
                            writer.write("ionic build android failed");
                            writer.newLine();
                            
                        }
                        
                        }
                       
                        URL url = new URL(serverbaseurl); // here is your URL path
                        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                        conn.setReadTimeout(15000 /* milliseconds */);
                        conn.setConnectTimeout(15000 /* milliseconds */);
                        conn.setRequestMethod("POST");
                        conn.setRequestProperty("Content-Type","application/x-www-form-urlencoded");
                        conn.setRequestProperty("Accept", "application/json");
                        conn.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
                        conn.setDoOutput(true);
                        DataOutputStream wr = new DataOutputStream(conn.getOutputStream());
                        wr.writeBytes(urlParameters);
                        wr.flush();
                        wr.close();
                        int responseCode=conn.getResponseCode();
                        if (responseCode == HttpURLConnection.HTTP_OK) {
                            System.out.println("\nSending 'POST' request to URL : " + serverbaseurl);
                            writer.write("Sending 'POST' request to URL : " + serverbaseurl);
                            writer.newLine();
                            System.out.println("Post parameters : " + urlParameters);
                            writer.write("Post parameters : " + urlParameters);
                            writer.newLine();
                            System.out.println("Response Code : " + responseCode);
                            writer.write("Response Code : " + responseCode);
                            writer.newLine();
                            BufferedReader in1 = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                            String inputLine;
                            StringBuffer response = new StringBuffer();
                            while ((inputLine = in1.readLine()) != null) {
                            response.append(inputLine);
                            }
                            in1.close();

                            //print result
                            System.out.println("printing result");
                            System.out.println(response.toString());
                        }
                        else {
                            System.out.println("Response is false "+responseCode);
                        }
                        writer.close();
                }
                catch ( Exception err ){
                    System.out.println( err.getMessage( ) );
                }
                
            }         
        });t1.start();
    }
}

