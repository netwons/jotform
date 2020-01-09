<?php

namespace App\Http\Controllers\Api\v1;

use App\FormModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    public function show()
    {
        $direct_link=FormModel::where('admin_id',auth()->user()->id)->get(['api_key']);
        $str=str_replace("{",'',$direct_link);
        $str1=str_replace("[\"api_key\":\"",'',$str);
        $str2=str_replace("\"}]",'',$str1);
        //echo $str2;
        $link= "https://form.jotform.me/".$str2;
        return $link;
        //return json_decode("https://twitter.com/intent/tweet?text=Hi!%0A%20{$link}");
    }

    public function sharing_twitter()
    {
        return "https://twitter.com/intent/tweet?text=Hi!%0A%20{$this->show()}";
    }
    public function sharing_facebook()
    {
        return "https://www.facebook.com/checkpoint/?next=https%3A%2F%2Fwww.facebook.com%2Fsharer.php%3Fu%3D{$this->show()}";
    }

    public function embed()
    {
        $r=$this->show();
        preg_match_all("/(?<=.me\/)[\W\w]*/i",$r,$t1);
        $t11= implode($t1[0]);
        preg_match_all("/https:\/\/form.jotform.me\//i",$r,$t);
        return "<script type=\"text/javascript\" src=\"".implode($t[0])."jform/".$t11."\"></script>";
    }

    public function iframe()
    {
        $r=$this->show();
        preg_match_all("/(?<=.me\/)[\W\w]*/i",$r,$t1);
        $t11= implode($t1[0]);
        $iframe="
    <iframe
      id=\"JotFormIFrame-{$t11}\"
      title=\"Masoud\"
      onload=\"window.parent.scrollTo(0,0)\"
      allowtransparency=\"true\"
      allowfullscreen=\"true\"
      allow=\"geolocation; microphone; camera\"
      src=\"{$r}\"
      frameborder=\"0\"
      style=\"width: 1px;
      min-width: 100%;
      height:539px;
      border:none;\"
      scrolling=\"no\"
    >
    </iframe>
    <script type=\"text/javascript\">
      var ifr = document.getElementById(\"JotFormIFrame-82625500337452\");
      if(window.location.href && window.location.href.indexOf(\"?\") > -1) {
        var get = window.location.href.substr(window.location.href.indexOf(\"?\") + 1);
        if(ifr && get.length > 0) {
          var src = ifr.src;
          src = src.indexOf(\"?\") > -1 ? src + \"&\" + get : src  + \"?\" + get;
          ifr.src = src;
        }
      }
      window.handleIFrameMessage = function(e) {
        if (typeof e.data === 'object') { return; }
        var args = e.data.split(\":\");
        if (args.length > 2) { iframe = document.getElementById(\"JotFormIFrame-\" + args[(args.length - 1)]); } else { iframe = document.getElementById(\"JotFormIFrame\"); }
        if (!iframe) { return; }
        switch (args[0]) {
          case \"scrollIntoView\":
            iframe.scrollIntoView();
            break;
          case \"setHeight\":
            iframe.style.height = args[1] + \"px\";
            break;
          case \"collapseErrorPage\":
            if (iframe.clientHeight > window.innerHeight) {
              iframe.style.height = window.innerHeight + \"px\";
            }
            break;
          case \"reloadPage\":
            window.location.reload();
            break;
          case \"loadScript\":
            var src = args[1];
            if (args.length > 3) {
                src = args[1] + ':' + args[2];
            }
            var script = document.createElement('script');
            script.src = src;
            script.type = 'text/javascript';
            document.body.appendChild(script);
            break;
          case \"exitFullscreen\":
            if      (window.document.exitFullscreen)        window.document.exitFullscreen();
            else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
            else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
            else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
            else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
            break;
        }
        var isJotForm = (e.origin.indexOf(\"jotform\") > -1) ? true : false;
        if(isJotForm && \"contentWindow\" in iframe && \"postMessage\" in iframe.contentWindow) {
          var urls = {\"docurl\":encodeURIComponent(document.URL),\"referrer\":encodeURIComponent(document.referrer)};
          iframe.contentWindow.postMessage(JSON.stringify({\"type\":\"urls\",\"value\":urls}), \"*\");
        }
      };
      if (window.addEventListener) {
        window.addEventListener(\"message\", handleIFrameMessage, false);
      } else if (window.attachEvent) {
        window.attachEvent(\"onmessage\", handleIFrameMessage);
      }
      </script>";
        return $iframe;
    }

}
