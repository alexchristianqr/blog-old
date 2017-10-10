<div id="disqus_thread"></div>
<script>

    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

    /*var disqus_config = function () {
        this.page.url = 'http://aquispe.com';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = location.pathname; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        this.page.title = 'Blogero'
    };*/

    (function () { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script'),
            env = '{{ $_SERVER['SERVER_NAME'] }}', shortname = '';
        if (env == 'dev.aquispe.com') {//modo developer
            shortname = 'blog-2nxabyt0jr';
        } else {//modo production
            shortname = 'aquispe';
        }
        s.src = 'https://' + shortname + '.disqus.com/embed.js';
        s.setAttribute('data-timestamp', + new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
