<%@ WebHandler Language="C#" Class="DataHandler" %>

using System;
using System.Web;
using System.Collections.Generic;
using Newtonsoft.Json;

public class DataHandler : IHttpHandler {
    
    public void ProcessRequest (HttpContext context) {
        var china = new { id = "China", name = "中国" };
        var usa = new { id = "USA", name = "美国" };
        var rsa = new { id = "Russia", name = "俄罗斯" };
        var en = new { id = "English", name = "英国" };
        var fra = new { id = "France", name = "法国" };
        List<object> list = new List<object>();
        list.Add(china);
        list.Add(usa);
        list.Add(rsa);
        list.Add(en);
        list.Add(fra);
        string returnJson = JsonConvert.SerializeObject(list);
        context.Response.ContentType = "text/plain";
        context.Response.Write(returnJson);        
    }
 
    public bool IsReusable {
        get {
            return false;
        }
    }

}