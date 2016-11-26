<?php
namespace YouTrack;

/**
 * A class describing a youtrack issue.
 *
 * @property string id Issue id in database
 * @method string getId() Issue id in database
 * @method setId(string $id) Issue id in database
 * @property string|null jiraId If issue was imported from JIRA, represents id, that it have in JIRA
 * @method string|null getJiraId() If issue was imported from JIRA, represents id, that it have in JIRA
 * @method setJiraId(string $jiraId) If issue was imported from JIRA, represents id, that it have in JIRA
 * @property string projectShortName Short name of the issue's project
 * @method string getProjectShortName() Short name of the issue's project
 * @method setProjectShortName(string $projectShortName) Short name of the issue's project
 * @property int numberInProject Number of issue in project
 * @method int getNumberInProject() Number of issue in project
 * @method setNumberInProject(int $numberInProject) Number of issue in project
 * @property string|null summary Summary of the issue
 * @method string|null getSummary() Summary of the issue
 * @method setSummary(string $summary) Summary of the issue
 * @property string|null description Description of the issue
 * @method string|null getDescription() Description of the issue
 * @method setDescription(string $description) Description of the issue
 * @property int created Time when issue was created (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @method int getCreated() Time when issue was created (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @property int updated Time when issue was last updated (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @method int getUpdated() Time when issue was last updated (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @property string updaterName Login of the user, that was the last, who updated the issue
 * @method string getUpdaterName() Login of the user, that was the last, who updated the issue
 * @method setUpdaterName(string $updaterName) Login of the user, that was the last, who updated the issue
 * @property int|null resolved If the issue is resolved, shows time, when resolved state was last set to the issue (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @method int|null getResolved() If the issue is resolved, shows time, when resolved state was last set to the issue (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @method setResolved(int $resolved) If the issue is resolved, shows time, when resolved state was last set to the issue (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
 * @property string reporterName Login of user, who created the issue
 * @method string getReporterName() Login of user, who created the issue
 * @method setReporterName(string $reporterName) Login of user, who created the issue
 * @property string voterName Login of user, that voted for issue
 * @method string getVoterName() Login of user, that voted for issue
 * @method setVoterName(string $voterName) Login of user, that voted for issue
 * @property int commentsCount Number of comments in issue
 * @method int getCommentsCount() Number of comments in issue
 * @property int votes Number of votes for issue
 * @method int getVotes() Number of votes for issue
 * @property string|null permittedGroup User group, that has permission to read this issue; if group is not set, it means that any user has access to this issue
 * @method string|null getPermittedGroup() User group, that has permission to read this issue; if group is not set, it means that any user has access to this issue
 * @method setPermittedGroup(string $permittedGroup) User group, that has permission to read this issue; if group is not set, it means that any user has access to this issue
 *
 * @link https://confluence.jetbrains.com/display/YTD65/Get+an+Issue
 */
class Issue extends BaseObject
{
    private $links = array();
    private $attachments = array();
    private $comments = array();
    private $history = array();

    public function __construct(\SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct($xml, $youtrack);
        if ($xml) {
            if (!empty($this->attributes['links'])) {
                $links = array();
                foreach ($xml->xpath('//field[@name="links"]') as $node) {
                    foreach ($node->children() as $link) {
                        $links[(string)$link] = array(
                            'type' => (string)$link->attributes()->type,
                            'role' => (string)$link->attributes()->role,
                        );
                    }
                }
                $this->__set('links', $links);
            }
            if (!empty($this->attributes['attachments'])) {
                $attachments = array();
                foreach ($xml->xpath('//field[@name="attachments"]') as $node) {
                    foreach ($node->children() as $attachment) {
                        $attachments[(string)$attachment] = array(
                            'url' => (string)$attachment->attributes()->url,
                        );
                    }
                }
                $this->__set('attachments', $attachments);
            }
        }
    }

    protected function updateChildrenAttributes(\SimpleXMLElement $xml)
    {
        foreach ($xml->children() as $nodeName => $node) {
            if ($nodeName == 'comment') {
                $this->comments[] = new Comment(new \SimpleXMLElement($node->asXML()));
                continue;
            }
            foreach ($node->attributes() as $key => $value) {
                if ($key == 'name') {
                    $key = $value;
                    $value = $node->value;
                }
                $key = (string)$key;

                if (count($value) > 1) {
                    $value = (array)$value;
                } else {
                    $value = (string)$value;
                }
                $this->__set($key, $value);
            }
        }
    }

    /**
     * @return User
     */
    public function getReporter()
    {
        return $this->youtrack->getUser($this->__get('reporterName'));
    }

    /**
     * @return bool
     */
    public function hasAssignee()
    {
        $name = $this->__get('Assignee');
        return !empty($name);
    }

    /**
     * @return User
     */
    public function getAssignee()
    {
        return $this->youtrack->getUser($this->__get('Assignee'));
    }

    /**
     * @return User
     */
    public function getUpdater()
    {
        return $this->youtrack->getUser($this->__get('updaterName'));
    }

    /**
     * @return array|Comment[]
     */
    public function getComments()
    {
        if (empty($this->comments)) {
            $this->comments = $this->youtrack->getComments($this->__get('id'));
        }
        return $this->comments;
    }

    /**
     * @return bool
     */
    public function hasComments()
    {
        return count($this->comments) > 0;
    }

    /**
     * @return array|Attachment[]
     */
    public function getAttachments()
    {
        if (empty($this->attachments)) {
            $this->attachments = $this->youtrack->getAttachments($this->__get('id'));
        }
        return $this->attachments;
    }

    /**
     * @return bool
     */
    public function hasAttachments()
    {
        return count($this->attachments) > 0;
    }

    /**
     * @return Link[]
     */
    public function getLinks()
    {
        if (empty($this->links)) {
            $this->links = $this->youtrack->getLinks($this->__get('id'));
        }
        return $this->links;
    }

    /**
     * @return bool
     */
    public function hasLinks()
    {
        return count($this->links) > 0;
    }

    /**
     * @return array
     */
    public function getHistory()
    {
        if (empty($this->history)) {
            $this->history = $this->youtrack->getIssueHistory($this->__get('id'));
        }
        return $this->history;
    }
}
