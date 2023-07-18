@extends('layout.layout')

@section('content')
<div class="center-align">
    <div class="container">
        <div class="row">
            <div class="col s12">&nbsp;</div>
            <div class="input-field col s12">
                <select id="testTypeSelect">
                    <option value="1" selected>Simple</option>
                    <option value="2">Multiple #1</option>
                    <option value="3" disabled>Multiple #2</option>
                </select>
                <label>Test type</label>
            </div>
            <div id="simpleDiv">
                <div class="input-field col s5">
                    <input type="text" id="link" class="autocomplete">
                    <label for="link">Link</label>
                </div>
                <div class="input-field col s1">
                    <input type="text" id="port" class="autocomplete">
                    <label for="port">Port</label>
                </div>
                <div class="input-field col s2">
                    <select id="testProtocolSelect">
                        <option value="HTTP" selected>HTTP</option>
                        <option value="OTHERS">Others</option>
                    </select>
                </div>
                <div class="input-field col s2">
                    <div id="testMethodSelectHttp">
                        <select>
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PATCH">PATCH</option>
                            <option value="PUT">PUT</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </div>
                    <div hidden id="testMethodSelectOthers">
                        <select>
                            <option value="SSH">SSH</option>
                            <option value="POP3">POP3</option>
                            <option value="IMAP">IMAP</option>
                            <option value="FTP">FTP</option>
                        </select>
                    </div>
                </div>
                <div class="input-field col s2">
                    <div id="testInterfaceSelectHttp">
                        <select>
                            <option value="CURL">Curl</option>
                            <option value="GUZZLE">Guzzle</option>
                        </select>
                    </div>
                    <div hidden id="testInterfaceSelectOthers">
                        <select>
                            <option value="FSOCK">fsock</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="multipleDiv1" class="input-field col s12" style="display: none;">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">&lt;url&gt;&nbsp;&lt;port&gt;&nbsp;&lt;type&gt;&nbsp;&lt;method&gt;&nbsp;&lt;interface&gt;</label>
            </div>
            <div id="multipleDiv2" class="input-field col s12" style="display: none;">
                <label for="autocomplete-input">Search - Multiple form 2</label>
            </div>
        </div>
    </div>
</div>
@endsection
