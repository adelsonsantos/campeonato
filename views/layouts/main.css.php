<style>
table.menu {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td.menu, th.menu {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th.menu, .table-dark thead th {
    border-color: #222;
    color: white;
    background-color: #222;
}
table.menu {
    width: 100%
}

.row{
    margin-left:0px;
    margin-right:0px;
}

#wrapper {
    margin-top: -20px;
    padding-left: 70px;
    transition: all .4s ease 0s;
    page-content
}

#sidebar-wrapper {
    margin-left: -150px;
    left: 70px;
    width: 150px;
    background: #222;
    position: fixed;
    height: 100%;
    z-index: 10000;
    transition: all .4s ease 0s;
}

.sidebar-nav {
    display: block;
    float: left;
    width: 150px;
    list-style: none;
    margin: 0;
    padding: 0;
}
#page-content-wrapper {
    padding-left: 0;
    margin-left: 0;
    width: 100%;
    height: auto;
}
#wrapper.active {
    padding-left: 150px;
}
#wrapper.active #sidebar-wrapper {
    left: 150px;
}

#page-content-wrapper {
    width: 100%;
}

#sidebar_menu li a, .sidebar-nav li a {
    color: #999;
    display: block;
    float: left;
    text-decoration: none;
    width: 150px;
    background: #252525;
    border-top: 1px solid #373737;
    border-bottom: 1px solid #1A1A1A;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}
.sidebar_name {
    padding-top: 25px;
    color: #fff;
    opacity: .7;
}

.sidebar-nav li {
    line-height: 40px;
    text-indent: 20px;
}

.sidebar-nav li a {
    color: #999999;
    display: block;
    text-decoration: none;
}

.sidebar-nav li a:hover {
    color: #fff;
    background: rgba(255,255,255,0.2);
    text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    line-height: 60px;
    font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

#main_icon
{
    float:right;
    padding-right: 65px;
    padding-top:20px;
}
.sub_icon
{
    float:right;
    padding-right: 65px;
    padding-top:10px;
}
.content-header {
    height: 65px;
    line-height: 65px;
}

.content-header h1 {
    margin: 0;
    margin-left: 20px;
    line-height: 65px;
    display: inline-block;
}

@media (max-width:767px) {
    #wrapper {
        padding-left: 70px;
        transition: all .4s ease 0s;
    }
    #sidebar-wrapper {
        left: 70px;
    }
    #wrapper.active {
        padding-left: 150px;
    }
    #wrapper.active #sidebar-wrapper {
        left: 150px;
        width: 150px;
        transition: all .4s ease 0s;
    }
}

</style>