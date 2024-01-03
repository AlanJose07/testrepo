var count=1;
var answered=1;
RightNow.namespace('Custom.Widgets.custom.CustomGuide');
Custom.Widgets.custom.CustomGuide = RightNow.Widgets.GuidedAssistant.extend({ 
 
 /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
		
        /**
         * Overrides RightNow.Widgets.GuidedAssistant#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
			
            this.parent();
        },

        /**
         * Overridable methods from GuidedAssistant:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _attachDomEvents: function()
        // _onSelectChange: function(e)
        // _onClick: function(evt)
        // answerQuestion: function(element, guideID, questionID, responseID, level, skipped)
        // _goToResponse: function(evt, args)
        // _goToQuestion: function(evt, args)
        // _answerQuestion: function(guideID, question, response, level)
        // _buildNextResult: function(response)
        // _buildQuestionHTML: function(question)
        // _createButtonHTML: function(question)
        // _createMenuHTML: function(question)
        // _createLinkHTML: function(question)
        // _createRadioHTML: function(question)
        // _createImageHTML: function(question)
        // _createTextInputHTML: function(question)
        // _callUrl: function(response)
        // _navigate: function(url, paramMap, win)
        // _post: function(url, paramMap, win)
        // _createTextResultHTML: function(response)
        // _createAnswersHTML: function(response)
        // _createNewGuide: function(guide, parentGuideID)
        // _createQuestionChatLink: function(guideID, questionID)
        // _createResolutionChatLink: function(guideID, questionID, responseID)
        // _displayRestartButton: function()
        // _removeElements: function(questionID)
        // _appendElement: function(element, parentGuideID)
        // _newContentAdded: function()
        // _focusTopOfGuide: function()
        // _getEnvironment: function()
        // samePage: function(win)
        // _goBackHelper: function()
        // _goBack: function()
        // _addPairs: function(question, responseValue, level)
        // _removePairs: function()
        // _getQuestionByID: function(domNodeID)
        // _getResponseByID: function(question, responseID)
        // _getPathToQuestion: function(nodes, questionID)
        // _getGuideParentResponse: function(questions, guideID)
        // _get: function(type, id)
        // _submitStats: function(action, details, queue, callback, scope)
        // _answerViewed: function(evt, args)
        // _linkClicked: function(evt, ids)
        // _addQuestionToChat: function(guideID, questionID)
        // _addResolutionToChat: function(guideID, questionID, responseID)
        // _recordAnswerViewed: function(guideID, questionID, responseID, answerID, callback)
        // _buildResponseID: function(questionID, responseID)
        // _highlightResponse: function(chosenResponse, questionType)
        // _toggleBackButton: function(show)
        // _toggleQuestion: function(question, show)
        // _hideFirstGuideQuestion: function(questionID)
        // _setAriaLoading: function(loadingOrNot)
        // _getGuideByID: function(guideID, responseID, questionID)
        // _getGuideResponse: function(response, origEventObject)
        // _initHistoryManager: function()
        // _restoreState: function(state)
        // _saveState: function(state)
		

		answerQuestion: function(element, guideID, questionID, responseID, level, skipped) {
		
		if(guideID !== this._currentGuideID) {
            if(!this._guide[guideID])
                throw new Error("Missing guide");
            else
                this._currentGuideID = guideID;
        }
        if(!this._hasRecordedInitialInteraction){
            RightNow.ActionCapture.record('guidedAssistance', 'interact', this._currentGuideID);
            this._hasRecordedInitialInteraction = true;
        }
        this._setAriaLoading(true);

        var question = this._getQuestionByID(questionID),
            response = this._getResponseByID(question, responseID);
			if(question) {
            this._currentLevel = level + 1;
            this._previousQuestions[level] = questionID;

            //make sure there are no questions below this one
            this._removeElements(questionID);
            this._removePairs(questionID);

            if(question.type === this.data.js.types.MENU_QUESTION || question.type === this.data.js.types.LIST_QUESTION) {
                if(element.get("options").item(element.get("selectedIndex")).get("value")) {
                    responseID = parseInt(element.get("options").item(element.get("selectedIndex")).get("value"), 10);
                    response = this._getResponseByID(question, responseID);
                }
                else {
                    this._previousQuestions.pop();
                    this._currentLevel--;
                    this._setAriaLoading(false);
                    return;
                }
            }
            else if(question.type === this.data.js.types.TEXT_QUESTION) {
                //grab the user-entered text and continue onward
                var input = this.Y.one(this.baseSelector + "_Response" + guideID + "_" + questionID + "_" + responseID);
                if(input) {
                    input.set("value", this.Y.Lang.trim(input.get("value")));
                    if(input.get("value") === "") {
                        input.focus();
                        this._setAriaLoading(false);
                        this._currentLevel--;
                        this._previousQuestions.pop();
                        return;
                    }
                    response.value = input.get("value");
                }
                else {
                    this._setAriaLoading(false);
                    return;
                }
            }
            this._addPairs(question, response.value, level);
            this._submitStats(RightNow.Ajax.CT.GA_SESSION_DETAILS, {
                ga_sid: this._guide[guideID].guideSessionID,
                ga_id: guideID,
                q_id: questionID,
                r_id: responseID,
                skipped: skipped
            }, true);

            //notify listeners of selection
            this._eo.data = {guideID: guideID, questionID: questionID, responseID: responseID, responseValue: response.value};
            RightNow.Event.fire("evt_GuideResponseSelected", this._eo);
			var agent=this.data.attrs.cid;
			var ses=this.data.attrs.ses;
			var question = this._getQuestionByID(questionID);
			var ques=question.name;
			var name=this.data.attrs.guide;
			var u_id=document.getElementById('u_id').innerHTML;
			var st_time=document.getElementById('st_time').innerHTML;
			if(answered==1)
			{
				RightNow.Ajax.makeRequest('/cc/ajaxCustom/qa_selected/', {agent:agent,name:name, questionID: ques,responseValue: response.text,u_id:u_id,ses:ses,st_time:st_time}, {
				successHandler: function(response) {
					console.log(response);
					}
			});
			}
			else
			{
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/qa_selected/', {agent:agent,name:name, questionID: ques, responseValue: response.text,u_id:u_id,ses:ses}, {
				successHandler: function(response) {
					console.log(response);
					}
			});
			}
			answered++;
            if(this.data.attrs.single_question_display) {
                //reset the user's response in case they go back
                if(question.type === this.data.js.types.RADIO_QUESTION || question.type === this.data.js.types.IMAGE_QUESTION)
                    element.set("checked", false);
                else if(question.type === this.data.js.types.MENU_QUESTION || question.type === this.data.js.types.LIST_QUESTION)
                    element.set("selectedIndex", 0);
                else if(question.type === this.data.js.types.TEXT_QUESTION)
                    element.set("value", "");
                if(this._guideAppended) {
                    this._hideFirstGuideQuestion(questionID);
                    this._guideAppended = false;
                }
                else {
                    this._toggleQuestion(question);
                }
                this._toggleBackButton(true);
            }
            else {
                if (question.type === this.data.js.types.LINK_QUESTION || question.type === this.data.js.types.BUTTON_QUESTION) {
                    //add appropriate visual cues as to what's been selected
                    this._highlightResponse(element, question.type);
                }
                else if (element && element.get("type") === "radio" && element.get("checked") === false) {
                    //manually check checkbox-type questions if they haven't been (agent navigation)
                    element.set("checked", true);
                }
            }

            this._buildNextResult(response);
            this._changeFired = false;
            this._setAriaLoading(false);
			}
		

    },
	 
		_buildNextResult: function(response) {
			
			var u_id=document.getElementById('u_id').innerHTML;
			var guide=this._currentGuideID;
			var agent=this.data.attrs.cid;
			var name=this.data.attrs.guide;
			var ses=this.data.attrs.ses;
			if(count===1)
			{
				
				
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/guidedetails/', {agent:agent,guide:guide,name:name}, {
				successHandler: function(response) {
					console.log(response);
					}
			});
			
			
			}
			count++;
        var result = this.Y.Node.create("<div class='rn_Result rn_Node'></div>"),
            deadEnd = true, question;

        if(!response || !response.type) {
            //tree was improperly saved w/o a response...
            result.set("innerHTML", "<div class='rn_ResultText'>" + RightNow.Interface.getMessage("NO_ANSWERS_FOUND_MSG") + "</div>");
        }
        else {
            this._currentResponse = response.responseID;
            this._saveState({
                guideID: this._currentGuideID,
                questionID: response.parentQuestionID,
                responseID: response.responseID,
                guideSession: this._guide[this._currentGuideID].guideSessionID,
                sessionID: this.data.js.session
            });
            if (response.url) {
                //do a post or get to an external site. Endusers: buh-bye now. Agents: stay with us.
                //opening a new window after an AJAX request returns will be blocked by modern browsers,
                // so we need to call _callUrl separately (since the page is opened in a new window,
                // we know that the click tracking should be recorded)
				
                RightNow.ActionCapture.record('guidedAssistance', 'finish', this._currentGuideID);
                RightNow.ActionCapture.flush();
                if(response.urlType === this.data.js.types.URL_GET && this.env.samePage() && this.data.attrs.call_url_new_window) {
                    RightNow.Ajax.CT.commitActions();
                    this._callUrl(response);
                }
                else {
                    RightNow.Ajax.CT.commitActions(function(){
                        this._callUrl(response);
                    }, this);
                }
                if(this.env.preview) {
                    //agents don't submit stats so callUrl won't get called above, allow agent preview
                    this._callUrl(response);
                }
                if(!this.env.console || this.env.previewEnduser) {
                    return;
                }
            }
            if(response.type & this.data.js.types.TEXT_RESPONSE) {
                //Text explanation
                RightNow.ActionCapture.record('guidedAssistance', 'finish', this._currentGuideID);
                result.append(this._createTextResultHTML(response) +
                        this._createResolutionChatLink(this._currentGuideID, response.parentQuestionID, response.responseID))
                       .addClass("rn_Text")
                       .set("id", this.baseDomID + "_Result" + this._currentGuideID + "_" + response.responseID);
            }
            if(response.type & this.data.js.types.ANSWER_RESPONSE && (!this.env.console || this.env.previewEnduser)) {
                //Answers
                RightNow.ActionCapture.record('guidedAssistance', 'finish', this._currentGuideID);
                result.append(this._createAnswersHTML(response))
                      .addClass("rn_Answers")
                      .set("id", this.baseDomID + "_Result" + this._currentGuideID + "_" + response.responseID);
            }
            if(response.type & this.data.js.types.QUESTION_RESPONSE) {
                //Question
				
                question = this._getQuestionByID(response.childQuestionID);
				
				q=this._buildQuestionHTML(question);
				q=q.replace("tailNum",this.data.attrs.tail);
				q=q.replace("tailNo",this.data.attrs.tail);
				q=q.replace("tail#",this.data.attrs.tail);
				q=q.replace("tailNu",this.data.attrs.tail);
				var ques=question.taglessText;
		
                result.append(q +
                        this._createQuestionChatLink(this._currentGuideID, response.childQuestionID))
                      .addClass("rn_Question")
                      .set("id", this.baseDomID + "_Question" + this._currentGuideID + "_" + response.childQuestionID);
                this._currentQuestion = response.childQuestionID;

                //Log the question being rendered
                this._submitStats(RightNow.Ajax.CT.GA_SESSION_DETAILS, {
                    ga_sid: this._guide[this._currentGuideID].guideSessionID,
                    ga_id: this._currentGuideID,
                    q_id: this._currentQuestion
                }, true);

                deadEnd = false;
            }
            if(response.type & this.data.js.types.GUIDE_RESPONSE && response.childGuideID) {
                //Another Guide
                if(result.get("innerHTML")) {
                    this._appendElement(result.removeClass("rn_Node"));
                }
                RightNow.Ajax.CT.commitActions();
                this._getGuideByID(response.childGuideID, response.responseID, this._currentQuestion);
                return;
            }
        }
        //Log response and (possibly) newly-rendered question
        RightNow.Ajax.CT.commitActions();
        this._appendElement(result);
        RightNow.Url.transformLinks(result);

        if(this.data.attrs.single_question_display && deadEnd && this._currentLevel > 2) {
            this._displayRestartButton();
        }
		
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/qa_selected/', {agent:agent,name:name, questionID: ques, responseValue:"Abandoned",u_id:u_id,ses:ses}, {
				successHandler: function(response) {
					console.log(response);
					}
			});

        if (question) {
            RightNow.Event.fire('evt_GuideQuestionRendered', new RightNow.Event.EventObject(this, {
                data: { question: question, guideID: this._currentGuideID }
            }));
			
			
			
        }

        this._newContentAdded();
    }

    },
	
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});